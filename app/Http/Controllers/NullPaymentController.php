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
                ->with(['payment.state', 'user']);

            return DataTables::of($query->get())->toJson(); 
        }
        return view('modules.reports.cancelled-payments');
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
    public function show(NullPayment $nullPayment)
    {
        dd($nullPayment);
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
