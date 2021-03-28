<?php

namespace App\Http\Controllers;

use App\NullPayment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NullPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = NullPayment::latest('null_payments.created_at')
                ->with(['user', 'payment.taxpayer']);

            return DataTables::of($query)
                ->addColumn('formatted_amount', function ($payment) {
                    return $payment->formatted_amount;
                })
                ->make(true);
        }

        return view('modules.reports.payments.cancelled-payments');
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
     * @param  \App\NullPayment  $nullPayment
     * @return \Illuminate\Http\Response
     */
    public function show($nullPayment, Request $request)
    {
        $nullPayment = NullPayment::find($nullPayment);

        if ($request->wantsJson()) {
            $data = $nullPayment->load(
                'payment.taxpayer',
                'payment.state',
                'user'
            ); 

           return response()->json($data);
        }

        return view('modules.reports.payments.show')
            ->with('row', $nullPayment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NullPayment  $nullPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(NullPayment $nullPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NullPayment  $nullPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NullPayment $nullPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NullPayment  $nullPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(NullPayment $nullPayment)
    {
        //
    }
}
