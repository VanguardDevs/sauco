<?php

namespace App\Http\Controllers;

use App\Services\SettlementService;
use App\Services\PaymentService;
use App\Taxpayer;
use App\Settlement;
use App\Receivable;
use App\Concept;
use App\Month;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ReceivableService;
use Auth;

class SettlementController extends Controller
{
    /**
     * @var SettlementService;
     */
    protected $settlement;
    protected $payment;
    protected $receivable;
    
    protected $typeform = 'edit';

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
        return view('modules.cashbox.list-settlements'); 
    }

    /**
     * Display null settlements
     */
    public function showNullSettlements()
    {
        return view('modules.cashbox.list-null-settlements');
    }

    /**
     * List all settlements, no matter what view
     */
    public function list(Request $request)
    {
        $query = Settlement::with(['state', 'concept', 'taxpayer'])
            ->orderBy('id', 'DESC');

        
        return DataTables::eloquent($query)->toJson();
    }

    public function onlyNull()
    {
        $query = Settlement::onlyTrashed()
            ->with(['taxpayer', 'concept', 'state'])
            ->orderBy('created_at', 'DESC');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Entry poin for settlement creation.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSettlements(Request $request, Taxpayer $taxpayer)
    {
        $url = 'taxpayers/'.$taxpayer->id.'/declarations';
        $month = Month::find($request->input('month'));
        $concept = Concept::whereCode('1')->first();
        
        // Check if taxpayer has a settlement for any month
        $settlement = Settlement::whereTaxpayerId($taxpayer->id)
            ->whereMonthId($month->id)
            ->first();

        $settlement = $this->settlement->make($taxpayer, $concept, $month);
        return redirect($url)
            ->withSuccess('¡Liquidación del mes de '.$month->name.' realizada!');
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
            if (!Auth::user()->can('process.settlements'))  {
                return redirect('cashbox/settlements')
                    ->withError('¡No puede procesar la liquidación!');
            }

            return view('modules.cashbox.select-settlement')
                ->with('row', $settlement);
        }
        // The settlement it's already processed    
        return view('modules.cashbox.register-settlement')
            ->with('typeForm', 'show')
            ->with('row', $settlement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function groupActivityForm(Settlement $settlement)
    {
        return view('modules.cashbox.register-settlement')
            ->with('row', $settlement)
            ->with('typeForm', 'edit-group');
    }
    
    public function normalCalcForm(Settlement $settlement)
    {
        return view('modules.cashbox.register-settlement')
            ->with('typeForm', 'edit-normal')
            ->with('row', $settlement);
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
        $isEditGroup = $request->has('edit-group');

        $amounts = $request->input('activity_settlements');

        if ($isEditGroup) {
            $amount = $amounts[0]; 
            $settlement = $this->settlement->handleUpdate($settlement, $amount, $isEditGroup); 
        } else {
            $settlement = $this->settlement->handleUpdate($settlement, $amounts, $isEditGroup);
        }

        // Create receivable
        $payment = $this->payment->make('LIQUIDACIÓN POR IMPUESTO DE ACTIVIDAD ECONÓMICA');
        $receivable = $this->receivable->make($settlement, $payment);

        return redirect('cashbox/settlements/'.$settlement->id)
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
