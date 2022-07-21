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
use App\Models\Requirement;
use App\Models\RequirementTaxpayer;
use App\Models\Correlative;
use App\Models\LiqueurLiquidation;
use App\Models\Credit;
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

        $concept = Concept::whereId($liquidation->concept_id)->first();

        $taxpayer = Taxpayer::whereId($payment->taxpayer_id)->first();

        $validator = $request->validate([
            'processed_at' => 'required',
            'method' => 'required'
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

        if ($payment->has('credits')){
            $payment->credits()->update([
                'generated_at' => $processedAt
            ]);
        }

        $payment->createMovements();

        if($concept->code == '001.005.000'){
            $requirement = Requirement::whereId('1')->first();

            $requirementTaxpayer = RequirementTaxpayer::create([
                'requirement_id' => $requirement->id,
                'taxpayer_id' => $taxpayer->id,
                'liquidation_id' => $liquidation->id,
                'active' => true
            ]);
        }


        if($concept->code == '001.005.001'){
            $requirement = Requirement::whereId('3')->first();

            $requirementTaxpayer = RequirementTaxpayer::create([
                'requirement_id' => $requirement->id,
                'taxpayer_id' => $taxpayer->id,
                'liquidation_id' => $liquidation->id,
                'active' => true
            ]);
        }


        /*if($concept->code == '21'){

            $licenses = License::whereTaxpayerId($taxpayer->id)->where('ordinance_id', '6')->with("liqueurs")->get();

            foreach($licenses as $license){

                $liqueur = Liqueur::whereLicenseId($license->id)->first();

                $liquidationLiqueur = $liqueur->liquidations->first();

                if ($license->active == false && $liquidationLiqueur->status_id == 2 && $liqueur =! null ) {

                    $license->update([
                        'active' => true
                    ]);
                }
            }
        }*/

        if($concept->code == '21' || $concept->code == '22'){

            $representation= $taxpayer->president()->first();

            $currentLiquidation = $payment->liquidations->first();

            $liquidationLiqueur = LiqueurLiquidation::whereLiquidationId($currentLiquidation->id)->first();

            $liqueur = Liqueur::whereId($liquidationLiqueur->liqueur_id)->first();

            $license = License::whereId($liqueur->license_id)->where('active', 'false')->where('ordinance_id', '6')->first();

            $status = $payment->liquidations()->first()->status_id;

            if ($license->active == false && $status == 2 && $liqueur =! null ) {
                $license->update([
                    'active' => true
                ]);
            }

            // $requirementTaxpayer = RequirementTaxpayer::whereTaxpayerId($taxpayer->id)->where('active', true)->first();

            // $requirementTaxpayer->update([
            //     'liquidation_id' => $liquidation->id,
            //     'active' => false
            // ]);

        }


        // if($concept->code == '21' || $concept->code == '22'){

        //     $representation= $taxpayer->president()->first();

        //     //$liqueur = Liqueur::whereRepresentationId($representation->id)->first();

        //     $license = License::whereRepresentationId($representation)->where('active', 'false')->where('ordinance_id', '6')->first();

        //     $correlative = Correlative::whereId($license->correlative_id)->first();

        //     $status = $payment->liquidations()->first()->status_id;

        //     if ($license->active == false && $status == 2 && $liqueur =! null ) {
        //         $license->update([
        //             'active' => true
        //         ]);
        //     }

        //     $requirementTaxpayer = RequirementTaxpayer::whereTaxpayerId($taxpayer->id)->where('active', true)->first();

        //     $requirementTaxpayer->update([
        //         'liquidation_id' => $liquidation->id,
        //         'active' => false
        //     ]);

        // }



        return redirect()->back()->withSuccess('¡Factura procesada!');
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
