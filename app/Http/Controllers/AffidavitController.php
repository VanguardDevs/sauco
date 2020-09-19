<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Year;
use App\Month;
use App\Liquidation;
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
     * @var $liquidation, $concept, $taxpayer, $month, $receivable, $payment
     */
    protected $economicActivityAffidavit;

    public function __construct(AffidavitService $economicActivityAffidavit)
    {
        $this->economicActivityAffidavit = $economicActivityAffidavit;
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

    public function show(Request $request, Affidavit $affidavit)
    {
        if ($request->wantsJson()) {
            $fines = $affidavit->shouldHaveFine();
            $fineData = ($fines)
                ? [
                    'apply' => true,
                    'concepts' => $fines 
                ]
                : ['apply' => false];

            return response()->json([
                'affidavit' => $affidavit->load(['user', 'payment']),
                'fine' => $fineData 
            ]);
        }

        if ($affidavit->amount == 0.00) {
            if (!Auth::user()->can('process.liquidations'))  {
                return redirect('cashbox/liquidations')
                    ->withError('¡No puede procesar la liquidación!');
            }

            return view('modules.taxpayers.affidavits.select')
                ->with('row', $affidavit);
        }

        // The liquidation it's already processed    
        return view('modules.taxpayers.affidavits.register')
            ->with('typeForm', 'show')
            ->with('row', $affidavit);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Liquidation  $liquidation
     * @return \Illuminate\Http\Response
     */
    public function groupActivityForm(Affidavit $affidavit)
    {
        return view('modules.taxpayers.affidavits.register')
            ->with('row', $affidavit)
            ->with('typeForm', 'edit-group');
    }
    
    /**
     * Show form for editing the specified resource.
     * @param \App\Liquidation $liquidation
     * @return \Illuminate\Http\Response
     */
    public function normalCalcForm(Affidavit $affidavit)
    {
        return view('modules.taxpayers.affidavits.register')
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
     * Check last liquidation status
     */
    public function checkLastAffidavit()
    {
        $lastAffidavit = Affidavit::whereTaxpayerId($this->taxpayer->id)
            ->latest()->first();
        
        if ($lastAffidavit) {
            // If last month liquidation isn't processed yet
            if ($lastAffidavit->amount == 0.00) {
                return $lastAffidavit;
            }
        }

        return false;
    }

    /**
     * Make a new Affidavit Liquidation
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

        return redirect('affidavits/'.$affidavit->id);
    }

    /**
     * Update affidavit
     * @return Illuminate\Response
     */
    public function update(Request $request, Affidavit $affidavit)
    {
        $isEditGroup = $request->has('edit-group');

        $amounts = $request->input('activity_liquidations');

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
     * @param Liquidation $liquidation
     * @return Illuminate\Response
     */
    public function makePayment(Affidavit $affidavit)
    {
        $liquidation = $affidavit->liquidation();
        $concept = Concept::whereCode(1)->first();

        if ($liquidation->exists()) {
            return redirect()->route('payments.show', $liquidation->first()->payment->first());
        }

        $affidavit->makeLiquidation();

        return redirect()->route('liquidations.index', $affidavit->taxpayer_id);
    }

    public function destroy(Affidavit $affidavit)
    {
        //
    }
}
