<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Year;
use App\Month;
use App\Settlement;
use App\Affidavit;
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

        return view('modules.taxpayers.affidavits.index')
            ->with('years', $years)
            ->with('taxpayer', $taxpayer);
    }

    public function listAffidavits(Taxpayer $taxpayer)
    {
        $query = $taxpayer->affidavits()
            ->orderBy('id', 'DESC')
            ->get();

        return DataTables::of($query)->toJson();
    }

    public function show(Affidavit $affidavit)
    {
        if ($affidavit->amount == 0.00) {
            if (!Auth::user()->can('process.settlements'))  {
                return redirect('cashbox/settlements')
                    ->withError('¡No puede procesar la liquidación!');
            }

            return view('modules.cashbox.select-settlement')
                ->with('row', $affidavit);
        }

        // The settlement it's already processed    
        return view('modules.cashbox.register-settlement')
            ->with('typeForm', 'show')
            ->with('row', $affidavit);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function groupActivityForm(Affidavit $affidavit)
    {
        return view('modules.cashbox.register-settlement')
            ->with('row', $affidavit)
            ->with('typeForm', 'edit-group');
    }
    
    /**
     * Show form for editing the specified resource.
     * @param \App\Settlement $settlement
     * @return \Illuminate\Http\Response
     */
    public function normalCalcForm(Affidavit $affidavit)
    {
        return view('modules.cashbox.register-settlement')
            ->with('typeForm', 'edit-normal')
            ->with('row', $affidavit);
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
        $affidavit = Affidavit::findOneByMonth($this->taxpayer, $this->month)
            ->first();
        
        // No affidavit found
        if (!$affidavit) {
            $pendingAffidavit = $this->checkLastAffidavit();

            if (!$pendingAffidavit) {
                return $this->store();
            } else {
               return $this->fireError("Debe procesar la declaración del mes de ".$pendingAffidavit->month->name.' - '.$pendingAffidavit->month->year->year);
            }
        // Selected month has already an affidavit created
        } else {
            return $this->fireError("La declaración del mes de ".
                $this->month->name." -  ".
                $this->month->year->year.
                " fue generada"
            );
        }
    }

    /**
     * Check last settlement status
     */
    public function checkLastAffidavit()
    {
        $lastAffidavit = Affidavit::whereTaxpayerId($this->taxpayer->id)
            ->latest()->first();
        
        if ($lastAffidavit) {
            // If last month settlement isn't processed yet
            if ($lastAffidavit->amount == 0.00) {
                return $lastAffidavit;
            }
        }

        return false;
    }

    /**
     * Make a new Affidavit Settlement
     * @return Illuminate\Response
     */
    public function store()
    {        
        $affidavit = Affidavit::create([
            'taxpayer_id' => $this->taxpayer->id,
            'month_id' => $this->month->id,
            'user_id' => auth()->user()->id,
            'amount' => 0.00
        ]);

        return redirect('affidavits/'.$affidavit->id)
            ->withSuccess('¡Declaración del mes de '.$this->month->name.' - '.$this->month->year->year.' realizada!');
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
    public function makePayment(Affidavit $affidavit)
    {
        if ($affidavit->payment()) {
            return redirect('affidavits/'.$affidavit->id)
                ->withError('¡La factura de la liquidación fue realizada!');
        }

        $payment = $this->payment->make($affidavit->taxpayer);
        $receivable = $this->receivable->make($affidavit, $payment);

        return redirect('cashbox/payments/'.$payment->id)
            ->withSuccess('¡Factura realizada!');
    }

    public function download(Settlement $settlement)
    {
        //
    }
}
