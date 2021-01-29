<?php

namespace App\Http\Controllers;

use App\Models\CanceledPayment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CanceledPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = CanceledPayment::latest('canceled_payments.created_at')
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
     * @param  \App\CanceledPayment  $canceledPayment
     * @return \Illuminate\Http\Response
     */
    public function show($canceledPayment, Request $request)
    {
        $canceledPayment = CanceledPayment::find($nullPayment);

        if ($request->wantsJson()) {
            $data = $canceledPayment->load(
                'payment.taxpayer',
                'payment.state',
                'user'
            );

           return response()->json($data);
        }

        return view('modules.reports.payments.show')
            ->with('row', $canceledPayment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CanceledPayment  $canceledPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(CanceledPayment $canceledPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CanceledPayment  $canceledPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CanceledPayment $canceledPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CanceledPayment  $canceledPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanceledPayment $canceledPayment)
    {
        //
    }
}
