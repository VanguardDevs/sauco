<?php

namespace App\Http\Controllers;

use App\Services\SettlementService;
use App\Services\PaymentService;
use App\Taxpayer;
use App\Settlement;
use App\Receivable;
use App\Concept;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ReceivableService;

class SettlementController extends Controller
{
    /**
     * @var SettlementService;
     */
    protected $settlement;
    protected $payment;
    protected $receivable;

    /**
     * Constructor method
     * @param SettlementService $settlementService
     */
    public function __construct(ReceivableService $receivable, PaymentService $payment, SettlementService $settlement)
    {
        $this->payment = $payment;
        $this->settlement = $settlement;
        $this->receivable = $receivable;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.cashbox.settlements'); 
    }

    /**
     * Display all null settlements
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNull()
    {
        return view('modules.cashbox.null-settlements');
    }

    /**
     * List all settlements, no matter what view
     */
    public function list(Request $request)
    {
        $query = Settlement::with(['state', 'concept', 'taxpayer']);
        
        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Entry poin for settlement creation.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSettlements(Request $request, Taxpayer $taxpayer)
    {
        // Check if taxpayer has pending settlements
        $hasSettlements = Settlement::whereTaxpayerId($taxpayer->id)
            ->whereStateId(1);
        
        if ($hasSettlements->first()) {
            return response()->json([
                'message' => '¡El contribuyente tiene liquidaciones por pagar!',
                'ok' => false
            ], 400);
        }

        // Create economic activity settlements
        $concept = Concept::whereCode('1')->first();
        $this->settlement->make($taxpayer, $concept);

        return response()->json([
            'message' => '¡Liquidaciones realizadas!',
            'ok' => true
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function show(Settlement $settlement)
    {
        if ($settlement->state->id == 1) {
            return view('modules.cashbox.register-settlement')
                ->with('typeForm', 'edit')
                ->with('row', $settlement);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function edit(Settlement $settlement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settlement $settlement)
    {
        $activitySettlements = $request->input('activity_settlements');
        $settlement = $this->settlement->handleUpdate($settlement, $activitySettlements);

        // Create receivable
        $payment = $this->payment->make();
        $receivable = $this->receivable->make($settlement, $payment);

        return redirect('cashbox/settlements')
            ->withSuccess('¡Liquidación procesada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settlement $settlement)
    {
        //
    }
}
