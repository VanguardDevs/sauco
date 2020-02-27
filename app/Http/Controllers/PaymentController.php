<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use App\PaymentType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Payments\PaymentsFormRequest;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.role:admin')->only('destroy');
        $this->middleware('has.role:liquidator|collector|admin')->only(['index', 'list']);
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

    public function list()
    {
        $query = Payment::with(['paymentState', 'settlements'])
            ->query();

        return DataTables::eloquent($query)->toJson();
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
            return view('modules.cashbox.show-payment');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
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
        /*
         * For later use
        $paymentState = PaymentState::whereDescription('PAGADA')->first();
        $paymentType = PaymentType::whereId($request->input('payment_type'))->first();

        $payment = Payment::find($payment->id);
        $payment->payment_state_id = $paymentState->id;
        $payment->payment_type_id = $paymentType->id;

        if ($paymentType->description != 'EFECTIVO') {
            $reference = $request->input('reference');
            $bankAccount = $request->input('bank_account');

            if (empty($reference) || empty($bankAccount)) {
                return redirect('payments/'.$payment->id)
                        ->withError('¡Faltan datos!');
            }

            $reference = Reference::create([
                'reference' => $request->input('reference'),
                'bank_account_id' => $request->input('bank_account'),
                'payment_id' => $payment->id
            ]);
        }
        $payment->save();

        return redirect('payments')
            ->withSuccess('¡Liquidación pagada!');
    }

    public function download(Payment $payment)
    {
        if ($payment->state->id != 2) {
            return response()->json([
                '¡La factura no ha sido pagada!', 400
            ]);
        }
         */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
