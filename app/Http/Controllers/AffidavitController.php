<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Month;
use App\Settlement;
use App\Concept;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Affidavits\AffidavitsCreateFormRequest;
use App\Services\SettlementService;
use Auth;

class AffidavitController extends Controller
{
    /** Initial variables
     * @var $settlement, $concept, $taxpayer, $month
     */
    protected $settlement;
    protected $concept;
    protected $taxpayer;
    protected $month;

    public function __construct(SettlementService $settlement, Concept $concept, Taxpayer $taxpayer, Month $month)
    {
        $this->taxpayer = $taxpayer;
        $this->month = $month;
        $this->concept = Concept::whereCode(1)->first();
        $this->settlement = $settlement;
        $this->middleware('auth');
    }

    public function index(Taxpayer $taxpayer)
    {
        $months = Month::where('id', '<', Carbon::now()->month);

        return view('modules.declarations.index')
            ->with('months', $months->pluck('name', 'id'))
            ->with('taxpayer', $taxpayer);
    }

    public function listAffidavits(Taxpayer $taxpayer)
    {
        $query = $taxpayer->declarations();

        return DataTables::eloquent($query)->toJson();
    }

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
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function groupActivityForm(Settlement $settlement)
    {
        return view('modules.cashbox.register-settlement')
            ->with('row', $settlement)
            ->with('typeForm', 'edit-group');
    }
    
    /**
     * Show form for editing the specified resource.
     * @param \App\Settlement $settlement
     * @return \Illuminate\Http\Response
     */
    public function normalCalcForm(Settlement $settlement)
    {
        return view('modules.cashbox.register-settlement')
            ->with('typeForm', 'edit-normal')
            ->with('row', $settlement);
    }


    public function create(AffidavitsCreateFormRequest $request, Taxpayer $taxpayer)
    {
        $month = Month::find($request->input('month'));
        $this->month = $month;
        $this->taxpayer = $taxpayer;

        return $this->validateStore();
    }

    /**
     * Validate by month
     */
    public function validateStore()
    {
        $settlement = $this->settlement->findOneByMonth($this->concept, $this->taxpayer, $this->month);
        $lastSettlement = $this->settlement->find($this->concept, $this->taxpayer)
            ->latest()->first();

        // If taxpayer has no affidavits
        if (!$lastSettlement) {
            if ($this->month->id == 1) {
                return $this->store();
            }
            return $this->fireError("Debe presentar la declaración para el mes de enero");
        }

        // Selected month has already an affidavit created
        // WE NEED TO IMPROVE VALIDATIONS
        if ($settlement->month->id == $this->month->id) {
            return $this->fireError("La liquidación del mes de ".$this->month->name." esta generada");
        }

        // If last settlement isn't processed yet
        if ($lastSettlement->month->id != $this->month->id) {
            if ($lastSettlement->state->id == 1) {
                return $this->fireError("Debe procesar la liquidación del mes de ".$lastSettlement->month->name);
            }
            return $this->store();
        }
    }

    /**
     * Make a new Affidavit Settlement
     * @return Illuminate\Response
     */
    public function store()
    {
        $settlement = $this->settlement->make($this->taxpayer, $this->concept, $this->month);

        return redirect('affidavits/'.$settlement->id)
            ->withSuccess('¡Liquidación del mes de '.$this->month->name.' realizada!');
    }

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

        return redirect('affidavits/'.$settlement->id)
            ->withSuccess('¡Liquidación procesada!');
    }

    /**
     * Returns an error message
     * @param $message
     * @return Illuminate\Response
     */
    public function fireError($message)
    {
        return redirect('taxpayers/'.$this->taxpayer->id.'/affidavits')
            ->withError($message);
    }

    public function download(Settlement $settlement)
    {
        dd($settlement);
    }
}
