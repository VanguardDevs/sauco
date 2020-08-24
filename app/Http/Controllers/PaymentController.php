<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use App\PaymentType;
use App\Payment;
use App\Reference;
use App\Settlement;
use App\Taxpayer;
use App\Organization;
use App\PaymentNull;
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
            ->whereStateId(2)
            ->orderBy('num', 'DESC');

        return DataTables::of($query)->toJson();
    }

    public function listByTaxpayer(Taxpayer $taxpayer)
    {
        $query = Payment::with(['state', 'user'])
            ->whereTaxpayerId($taxpayer->id)
            ->orderBy('processed_at', 'DESC');

        return DataTables::eloquent($query)->toJson();
    }

    public function onlyNull()
    {
        $query = Payment::onlyTrashed()
            ->with(['taxpayer', 'state'])
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
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if ($payment->state->id == 1) {
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
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if ($request->input('method') != '3') {
            $reference = $request->input('reference');

            if (empty($reference)){
                return redirect('payments/'.$payment->id)
                        ->withError('¡Faltan datos!');
            }

            $payment->reference()->create([
                'reference' => $reference,
                'account_id' => 1, 
            ]);
        }

        $paymentNum = Payment::newNum();
        $processedAt = Carbon::now();

        $payment->update([
            'user_id' => Auth::user()->id, 
            'payment_method_id' => $request->input('method'),
            'state_id' => 2,
            'observations' => $request->input('observations'),
            'num' => $paymentNum,
            'processed_at' => $processedAt
        ]);

        return redirect()->back()
            ->withSuccess('¡Factura procesada!');
    }

    public function download(Payment $payment)
    {
        if ($payment->state->id == 1) {
            return redirect()->back()
                ->withError('¡La factura no ha sido procesada!');
        }

        $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';
        $taxpayer = $payment->taxpayer;

        if ($payment->invoiceModel->code == 2) {
            $denomination = (!!$taxpayer->commercialDenomination) ? $taxpayer->commercialDenomination->name : $taxpayer->name;
            $vars = ['payment', 'reference', 'denomination'];

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('modules.cashbox.pdf.payment', compact($vars)) 
                ->stream('factura-'.$payment->id.'.pdf');
        } else {
            $organization = Organization::first();
            $vars = ['payment', 'reference', 'organization'];

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('modules.cashbox.pdf.withholding', compact($vars)) 
                ->stream('factura-'.$payment->id.'.pdf');
        }
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Payment $payment)
    {
        if ($payment->state_id == 2 && !Auth::user()->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => '¡La factura está pagada!'
            ]);
        }

        // Delete receivables and payment but keep settlements
        $settlements = Settlement::where('payment_id', $payment->id);

        // Delete settlements and payment
        $settlements->delete();
        $payment->delete();

        $payment->nullPayment()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()
            ->withSuccess('¡Pago anulado!');
    }
}
