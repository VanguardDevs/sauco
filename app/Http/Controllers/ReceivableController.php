<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PaymentType;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReceivableController extends Controller
{    
    private $typeForm = 'show';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.receivables.index');
    }

    public function list()
    { 
        $query = Payment::with('taxpayer')
            ->whereStateId(1)
            ->orderBy('id', 'DESC');

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
     * @param  \App\Receivable  $receivable
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receivable  $receivable
     * @return \Illuminate\Http\Response
     */
    public function edit(Receivable $receivable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receivable  $receivable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receivable $receivable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receivable  $receivable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receivable $receivable)
    {
        //
    }
}
