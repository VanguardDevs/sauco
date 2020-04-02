<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Year;
use App\Month;
use App\Settlement;
use App\Concept;
use App\Services\ReceivableService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Affidavits\AffidavitsCreateFormRequest;
use App\Services\SettlementService;
use Auth;

class AffidavitController extends Controller
{
    /** Initial variables
     * @var $settlement, $concept, $taxpayer, $month, $receivable, $payment
     */
    protected $settlement;
    protected $concept;
    protected $taxpayer;
    protected $month;
    protected $receivable;
    protected $payment;

    public function __construct(ReceivableService $receivable, PaymentService $payment, SettlementService $settlement, Concept $concept, Taxpayer $taxpayer, Month $month)
    {
        $this->taxpayer = $taxpayer;
        $this->month = $month;
        $this->concept = Concept::whereCode(1)->first();
        $this->payment = $payment;
        $this->receivable = $receivable;
        $this->settlement = $settlement;
        $this->middleware('auth');
    }

    public function index(Taxpayer $taxpayer)
    {
        $years = Year::pluck('year', 'id');

        return view('modules.declarations.index')
            ->with('years', $years)
            ->with('taxpayer', $taxpayer);
    }

    public function listAffidavits(Taxpayer $taxpayer)
    {
        $query = $taxpayer->declarations()
            ->orderBy('id', 'DESC');

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
        $settlement = $this->settlement
            ->findOneByMonth($this->concept, $this->taxpayer, $this->month);
        
        // No affidavit found
        if (!$settlement) {
            $pendingSettlement = $this->checkLastSettlement();

            if (!$pendingSettlement) {
                return $this->store();
            } else {
               return $this->fireError("Debe procesar la liquidación del mes de ".$pendingSettlement->month->name.' - '.$pendingSettlement->month->year->year);
            }
        // Selected month has already an affidavit created
        } else {
            return $this->fireError("La liquidación del mes de ".
                $this->month->name." -  ".
                $this->month->year->year.
                " esta generada"
            );
        }
    }

    /**
     * Check last settlement status
     */
    public function checkLastSettlement()
    {
        $lastSettlement = $this->settlement->find($this->concept, $this->taxpayer)
            ->latest()->first();
        
        if ($lastSettlement) {
            // If last month settlement isn't processed yet
            if ($lastSettlement->state->id == 1) {
                return $lastSettlement;
            }
        }
        return true;
    }

    /**
     * Make a new Affidavit Settlement
     * @return Illuminate\Response
     */
    public function store()
    {
        $settlement = $this->settlement->make($this->taxpayer, $this->concept, $this->month);

        return redirect('affidavits/'.$settlement->id)
            ->withSuccess('¡Liquidación del mes de '.$this->month->name.' - '.$this->month->year->year.' realizada!');
    }

    /**
     * Update affidavit
     * @return Illuminate\Response
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

    /**
     * Make a payment
     * @param Settlement $settlement
     * @return Illuminate\Response
     */
    public function makePayment(Settlement $settlement)
    {
        if ($settlement->payment()) {
            return redirect('affidavits/'.$settlement->id)
                ->withError('¡La factura de la liquidación fue realizada!');
        }
        $payment = $this->payment->make('LIQUIDACIÓN POR IMPUESTO DE ACTIVIDAD ECONÓMICA');
        $receivable = $this->receivable->make($settlement, $payment);

        return redirect('affidavits/'.$settlement->id)
            ->withSuccess('¡Factura realizada!');
    }

    public function download(Settlement $settlement)
    {
        //
    }
}
