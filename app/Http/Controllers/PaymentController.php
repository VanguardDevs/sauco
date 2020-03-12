<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use App\PaymentType;
use App\Payment;
use App\Reference;
use App\Receivable;
use App\Taxpayer;
use App\EconomicActivitySettlement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
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
        $this->middleware('has.role:admin')->only('destroy');
        $this->middleware('has.role:liquidator|collector|admin|liquidation-chief|collection-chief')->only(['index', 'list','show']);
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

    public function showNullPayments()
    {
        return view('modules.cashbox.list-null-payments');
    }

    public function list()
    { 
        $query = Payment::list() 
            ->whereNull('payments.deleted_at')
            ->orderBy('status', 'ASC');

        return DataTables::of($query)->toJson();
    }

    public function onlyNull()
    {
        $query = Payment::list()
            ->whereNotNull('payments.deleted_at')
            ->orderBy('id', 'ASC');
        
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
        if (Auth::user()->can('process.payments') && $payment->state->id == 1) {
            $this->typeform = 'edit';
        }

        $taxpayer = $payment->settlements->first()->taxpayer;

        return view('modules.cashbox.register-payment')
            ->with('row', $payment)
            ->with('types', PaymentType::exceptNull())
            ->with('methods', PaymentMethod::exceptNull())
            ->with('taxpayer', $taxpayer)
            ->with('typeForm', $this->typeform);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment = Payment::find($payment->id);
        $payment->state_id = 2;
        $payment->payment_type_id = 2;
        $payment->payment_method_id = $request->input('method');
        $payment->observations = $request->input('observations');

        if ($request->input('method') != '3') {
            $reference = $request->input('reference');

            if (empty($reference)){
                return redirect('payments/'.$payment->id)
                        ->withError('¡Faltan datos!');
            }

            $reference = Reference::create([
                'reference' => $request->input('reference'),
                'account_id' => 1, // For later use, select account
                'payment_id' => $payment->id
            ]);
        }
        $payment->save();

        return redirect('cashbox/payments')
            ->withSuccess('¡Factura procesada!');
    }

    public function download(Payment $payment)
    {
        if ($payment->state->id == 1) {
            return redirect('cashbox/payments')
                ->withError('¡La factura no ha sido procesada!');
        }

        $settlement = $payment->receivables->first()->settlement;
        $taxpayer = $settlement->taxpayer;
        $user = $settlement->user;
        $billNum = str_pad($payment->id, 8, '0', STR_PAD_LEFT);
        $reference = (!!$payment->reference) ? $payment->reference->reference : 'S/N';
        $denomination = (!!$taxpayer->commercialDenomination) ? $taxpayer->commercialDenomination->name : $taxpayer->name;
        $pdf = PDF::LoadView('modules.cashbox.pdf.payment', compact(['user','payment', 'billNum', 'reference', 'taxpayer', 'denomination']));

        return $pdf->download('Factura '.$payment->id.'.pdf');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if (!Auth::user()->hasRole('admin')) {
            return response()->json([
                'message' => '¡Usuario no permitido!'
            ]);
        }

        // First delete each economic Activity Settlement if exists
        foreach($payment->settlements as $settlement) {
            if ($settlement->concept->code == 1) {
                EconomicActivitySettlement::where('settlement_id', $settlement->id)
                    ->delete();
            }
            $settlement->delete();
        }
        // Delete receivables and payment
        Receivable::where('payment_id', $payment->id)->delete();
        $payment->delete();

        return redirect('cashbox/payments')
            ->withSuccess('¡Pago anulado!');
    }
}
