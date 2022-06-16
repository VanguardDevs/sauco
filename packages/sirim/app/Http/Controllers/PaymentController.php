<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Payment;
use App\Models\Fine;
use App\Models\Concept;
use App\Models\Reference;
use App\Models\Settlement;
use App\Models\Taxpayer;
use App\Models\PaymentNull;
use App\Models\Liquidation;
use App\Models\PetroPrice;
use App\Models\Liqueur;
use App\Models\License;
use App\Models\LiqueurParameter;
use App\Models\Year;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Http\Requests\AnnullmentRequest;
use PDF;
use Auth;

class PaymentController extends Controller
{
    /**
     * Payment form type
     * @var $typeform
     */
    private $typeform = 'show';

    public function __construct()
    {
        $this->middleware('can:null.payments')->only('destroy');
        $this->middleware('can:process.payments')->only('update');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.cashbox.list-payments');
    }

    public function listProcessed()
    {
        $query = Payment::with('taxpayer')
            ->whereStatusId(2)
            ->orderBy('num', 'DESC');

        return DataTables::of($query)
            ->addColumn('pretty_amount', function ($payment) {
                return $payment->pretty_amount;
            })
            ->make(true);
    }

    public function listByTaxpayer(Taxpayer $taxpayer)
    {
        $query = $taxpayer->payments()
            ->with('status')
            ->orderBy('processed_at', 'DESC');

        return DataTables::of($query)
            ->addColumn('pretty_amount', function ($payment) {
                return $payment->pretty_amount;
            })
            ->make(true);
    }

    public function onlyNull()
    {
        $query = Payment::onlyTrashed()
            ->with(['taxpayer', 'status'])
            ->orderBy('id', 'DESC');

        return DataTables::of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if ($payment->status_id == 1) {
            if (auth()->user()->can('process.payments')) {
                $this->typeform = 'edit';
            }
        }

        return view('modules.taxpayers.payment')
            ->with('row', $payment)
            ->with('types', PaymentType::exceptNull())
            ->with('methods', PaymentMethod::exceptNull())
            ->with('typeForm', $this->typeform);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {

        $liquidation = $payment->liquidations->first();

        $Oldconcept = Concept::whereId($liquidation->concept_id)->first();


        $validator = $request->validate([
            'processed_at'     => 'required',
            'method'  => 'required'
        ]);

        if ($request->input('method') != '3') {
            $reference = $request->input('reference');

            if (empty($reference)){
                return redirect('payments/'.$payment->id)
                        ->withError('¡Faltan datos!');
            }

            $payment->references()->create([
                'reference' => $reference,
                'account_id' => 1,
            ]);
        }


        if($Oldconcept->code == '001.005.000'){

            $petro = PetroPrice::latest()->first()->value;

            $liqueur = $liquidation->liqueur->first();

            $liqueur_parameter = LiqueurParameter::whereId($liqueur->liqueur_parameter_id)->first();

            $amount = $petro*$liqueur_parameter->authorization_registry_amount;

            $emissionDate = Carbon::now();
            $expirationDate = $emissionDate->copy()->addYears(1);

            $taxpayer = $payment->taxpayer_id;


            // Creates a new license with the details of the old one

            $oldLicense = License::whereId($liqueur->license_id)->first();

            //dd($oldLicense);

            $license = License::create([
                'num' => $oldLicense->num,
                'emission_date' => $emissionDate,
                'expiration_date' => $expirationDate,
                'ordinance_id' => $oldLicense->ordinance_id,
                'correlative_id' => $oldLicense->correlative_id,
                'taxpayer_id' => $taxpayer,
                'representation_id' => $oldLicense->representation_id,
                'user_id' => Auth::user()->id,
                'active' => false
            ]);


            // Should the old license be deleted?

            //$oldLicense->delete();


            $liqueur->update([
                'license_id' => $license->id
            ]);

            //Update liqueur 

            $updatedLiqueur = Liqueur::whereLicenseId($license->id)->first();


            $currYear = Year::where('year', Carbon::now()->year)->first();

            $newConcept = Concept::whereCode('21')->first();


            $liquidation_authorization = Liquidation::create([
                'num' => Liquidation::getNewNum(),
                'object_payment' =>  $newConcept->name.' - AÑO '.$currYear->year,
                'amount' => $amount,
                'liquidable_type' => Liquidation::class,
                'concept_id' => $newConcept->id,
                'liquidation_type_id' => $newConcept->liquidation_type_id,
                'status_id' => 1,
                'taxpayer_id' => $taxpayer
            ]);

            $payment_authorization = Payment::create([
                'status_id' => 1,
                'user_id' => Auth::user()->id,
                'amount' => $amount,
                'payment_method_id' => 1,
                'payment_type_id' => 1,
                'taxpayer_id' => $taxpayer
            ]);

            $updatedLiqueur->liquidations()->sync($liquidation_authorization);


            $payment_authorization->liquidations()->sync($liquidation_authorization);
        }




        $paymentNum = Payment::getNewNum(2);
        $processedAt = $request->processed_at.' '.Carbon::now()->toTimeString();

        $payment->update([
            'user_id' => Auth::user()->id,
            'payment_method_id' => $request->input('method'),
            'status_id' => 2,
            'observations' => $request->input('observations'),
            'num' => $paymentNum,
            'processed_at' => $processedAt
        ]);

        $payment->liquidations()->update([
            'status_id' => 2
        ]);

        $payment->createMovements();

        return redirect()->back()
            ->withSuccess('¡Factura procesada!');
    }

    public function download(Payment $payment)
    {
        if ($payment->status->id == 1) {
            return redirect()->back()
                ->withError('¡La factura no ha sido procesada!');
        }

        $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';
        $taxpayer = $payment->taxpayer;

        $denomination = (!!$taxpayer->commercialDenomination) ? $taxpayer->commercialDenomination->name : $taxpayer->name;

        if ($payment->type == 1) { // Retención
            $liquidation = $payment->liquidations()->first();
            $vars = ['payment', 'reference', 'denomination', 'liquidation'];

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('pdf.withholding', compact($vars))
                ->stream('factura-'.$payment->id.'.pdf');
        } else {
            $vars = ['payment', 'reference', 'denomination'];

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('pdf.payment', compact($vars))
                ->stream('factura-'.$payment->id.'.pdf');
        }
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Payment $payment)
    {
        if ($payment->status_id == 2) {
            $payment->movements()->delete();
            $payment->liquidations()->update(['status_id' => 1]);
        }
        $payment->delete();

        $payment->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 4
        ]);

        return redirect()->back()
            ->withSuccess('¡Pago anulado!');
    }



    public function ticket(Payment $payment)
    {
        if ($payment->status->id == 1) {
            return redirect()->back()
                ->withError('¡La factura no ha sido procesada!');
        }

        $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';
        $taxpayer = $payment->taxpayer;

        $denomination = (!!$taxpayer->commercialDenomination) ? $taxpayer->commercialDenomination->name : $taxpayer->name;
        $liquidation = $payment->liquidations()->first();
        $customPaper = array(0,0,228,400);

            $vars = ['payment', 'reference', 'denomination', 'liquidation'];

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('pdf.payment-ticket', compact($vars))
                ->setPaper($customPaper)
                ->stream('factura-'.$payment->id.'.pdf');

   }
}
