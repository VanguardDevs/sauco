<?php

namespace App\Http\Controllers;

use App\Services\SettlementService;
use App\Taxpayer;
use App\Settlement;
use App\Concept;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SettlementController extends Controller
{
    /**
     * @var SettlementService;
     */
    protected $settlement;
    
    /**
     * Constructor method
     * @param SettlementService $settlementService
     */
    public function __construct(SettlementService $settlement)
    {
        $this->settlement = $settlement;
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
        $query = Settlement::with(['state', 'concept']);
        
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
        //
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
        //
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
