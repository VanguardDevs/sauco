<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\Payment;
use App\PaymentState;
use App\PaymentType;
use App\Reference;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.payments.index');
    }

    public function list()
    {
        $query = Payment::query()
            ->with('paymentState');
            // ->with('taxpayer');

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
        $paymentTypes = PaymentType::exceptNull();

        return view('modules.payments.show')
            ->with('row', $payment)
            ->with('paymentTypes', $paymentTypes)
            ->with('bankAccounts', BankAccount::pluck('bank_name', 'id'))
            ->with('typeForm', 'update');
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
        $paymentState = PaymentState::whereDescription('PAGADA')->first();
        $paymentType = PaymentType::whereId($request->input('payment_type'))->first();

        $payment = Payment::find($payment->id);
        $payment->payment_state_id = $paymentState->id;
        $payment->payment_type_id = $paymentType->id;

        if ($paymentType->description != 'DEPÓSITO') {
            $reference = new Reference([
                'reference' => '',
                'bank_account_id' => $request->input('bank_account'),
                'payment_id' => $payment->id
            ]);
            $reference->save();
        }
        $payment->save();

        return redirect('payments')->withSuccess('¡Liquidación pagada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
    }
}
