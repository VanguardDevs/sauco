<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Year;
use App\Month;
use App\Settlement;
use App\Fine;
use App\Affidavit;
use App\Payment;
use App\EconomicActivityAffidavit;
use App\Concept;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Affidavits\AffidavitsCreateFormRequest;
use Auth;
use App\Services\AffidavitService;

class AffidavitController extends Controller
{
    /** Initial variables
     * @var $settlement, $concept, $taxpayer, $month, $receivable, $payment
     */
    protected $economicActivityAffidavit;
    protected $taxpayer;
    protected $month;

    public function __construct(AffidavitService $economicActivityAffidavit, Taxpayer $taxpayer, Month $month)
    {
        $this->taxpayer = $taxpayer;
        $this->economicActivityAffidavit = $economicActivityAffidavit;
        $this->month = $month;
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

        $activities = $this->taxpayer->economicActivities;
        $data = Array();

        foreach($activities as $activity) {
            array_push($data, Array(
                'amount' => 0.00,
                'brute_amount' => 0.00,
                'affidavit_id' => $affidavit->id,
                'economic_activity_id' => $activity->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));
        }

        EconomicActivityAffidavit::insert($data);

        return redirect('affidavits/'.$affidavit->id)
            ->withSuccess('¡Declaración del mes de '.$this->month->name.' - '.$this->month->year->year.' realizada!');
    }

    /**
     * Update affidavit
     * @return Illuminate\Response
     */
    public function update(Request $request, Affidavit $affidavit)
    {
        $isEditGroup = $request->has('edit-group');

        $amounts = $request->input('activity_settlements');

        if ($isEditGroup) {
            $amount = $amounts[0]; 
            $totalAmount = $this->economicActivityAffidavit->updateByGroup($affidavit, $amount);
        } else {
            $totalAmount = $this->economicActivityAffidavit->update($affidavit, $amounts);
        }

        $processedAt = Carbon::now();

        $affidavit->update([
            'amount' => $totalAmount,
            'user_id' => auth()->user()->id,
            'processed_at' => $processedAt,
        ]);

        $this->makePayment($affidavit);
        
        return redirect('affidavits/'.$affidavit->id)
            ->withSuccess('¡Declaración procesada!');
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
        if ($affidavit->payment()->first()) {
            return redirect('affidavits/'.$affidavit->id)
                ->withError('¡La factura de la liquidación fue realizada!');
        }

        $payment = Payment::create([
            'num' => Payment::newNum(),
            'state_id' => 1,
            'user_id' => auth()->user()->id,
            'amount' => $affidavit->amount,
            'payment_method_id' => 1,
            'payment_type_id' => 1,
            'taxpayer_id' => $affidavit->taxpayer_id
        ]);

        $month = Month::find($affidavit->month_id);

        $payment->settlements()->create([
            'num' => Settlement::newNum(),
            'object_payment' =>  $this->message($month),
            'affidavit_id' => $affidavit->id,
            'amount' => $affidavit->amount
        ]);

        $this->applyFine($affidavit, $payment);
        $payment->updateAmount();
    }
    
    public function message(Month $month)
    {
        $concept = Concept::whereCode(1)->first();

        return $concept->name.': '.$month->name.' - '.$month->year->year;
    }

    public function applyFine(Affidavit $affidavit, Payment $payment)
    {
        $concept = $this->checkForFine($affidavit);

        if ($concept) {
            $amount = Fine::calculateAmount($affidavit->amount, $concept);

            $fine = $concept->fines()->create([
                'amount' => $amount,
                'active' => true,
                'taxpayer_id' => $affidavit->taxpayer_id,
                'user_id' => $affidavit->user_id,
            ]);

            $settlement = $fine->settlement()->create([
                'num' => Settlement::newNum(),
                'object_payment' => $concept->name,
                'amount' => $amount,
                'payment_id' => $payment->id 
            ]);
        }
    }

    public function checkForFine($affidavit)
    {
        if (!$this->hasException($affidavit)) { 
            if ($affidavit->month->year->year != 2020) {
                return Concept::whereCode(2)->first();
            }
        }
        return false;
    }

    public function hasException($settlement)
    {
        if ($settlement->taxpayer->economicActivities->first()->code == 123456) {
            return true;
        }
        return false;
    }

    public function destroy(Affidavit $affidavit)
    {
        if (!Auth::user()->hasRole('admin')) {
            return response()->json([
                'message' => '¡Acción no permitida!'
            ]);
        }

        $affidavit->delete();

        return redirect()->back()
            ->with('success', '¡Liquidación anulada!');   
    }
}
