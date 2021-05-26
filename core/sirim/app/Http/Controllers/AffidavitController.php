<?php

namespace App\Http\Controllers;

use App\Models\Taxpayer;
use App\Models\Year;
use App\Models\Month;
use App\Models\Liquidation;
use App\Models\Affidavit;
use App\Models\Payment;
use App\Models\EconomicActivityAffidavit;
use App\Models\Concept;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Affidavits\AffidavitsCreateFormRequest;
use Auth;
use App\Http\Requests\AnnullmentRequest;
use App\Services\AffidavitService;

class AffidavitController extends Controller
{
    /** Initial variables
     * @var $settlement, $concept, $taxpayer, $month, $receivable, $payment
     */
    protected $economicActivityAffidavit;

    public function __construct(AffidavitService $economicActivityAffidavit)
    {
        $this->economicActivityAffidavit = $economicActivityAffidavit;
        $this->middleware('can:null.settlements')->only('destroy');
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = Affidavit::whereNotNull('processed_at')
                ->with('taxpayer', 'user', 'month.year')
                ->orderBy('processed_at', 'DESC');

            return DataTables::of($query)
                ->make(true);
        }

        return view('modules.reports.affidavits.index');
    }

    public function byTaxpayer(Request $request, Taxpayer $taxpayer)
    {
        if ($request->wantsJson()) {
            $query = $taxpayer->affidavits()
                ->with('liquidation')
                ->orderBy('id', 'DESC')
                ->get();

            return DataTables::of($query)->toJson();
        }
        $years = Year::pluck('year', 'id');

        return view('modules.taxpayers.affidavits.index')
            ->with('years', $years)
            ->with('taxpayer', $taxpayer);
    }

    public function show(Request $request, Affidavit $affidavit)
    {
        if ($request->wantsJson()) {
            $fines = $affidavit->shouldHaveFine();
            $fineData = ['apply' => false];

            if ($fines) {
                $concept = [ Concept::whereCode(3)->first() ];

                if ($fines > 1) {
                    $concept = [ $concept[0], $concept[0] ];
                }

                $fineData = [
                    'apply' => true,
                    'concepts' => $concept
                ];
            }

            $affidavitData = collect(Affidavit::find(14684)->load('user'))
                    ->merge([
                        'payment' => Affidavit::find(14684)->payment()->first()
                    ]);

            return response()->json([
                'affidavit' => $affidavitData,
                'fine' => $fineData
            ]);
        }

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
     * @param  \App\Models\Settlement  $settlement
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
     * @param \App\Models\Settlement $settlement
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

        return redirect('affidavits/'.$affidavit->id);
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

        $totalBruteAmount = $affidavit
            ->economicActivityAffidavits()
            ->sum('brute_amount');

        $affidavit->update([
            'total_brute_amount' => $totalBruteAmount,
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
     * @param Settlement $settlement
     * @return Illuminate\Response
     */
    public function makePayment(Affidavit $affidavit)
    {
        $payment = $affidavit->payment();

        if ($payment->count()) {
            return redirect()->route('payments.show', $payment->first());
        }

        $payment = $affidavit->mountPayment();

        $liquidation = $affidavit->makeLiquidation();

        $payment->liquidations()->sync($liquidation);

        $payment->checkForFine();

        return redirect()->route('payments.show', $payment->id);
    }

    public function message(Month $month)
    {
        $concept = Concept::whereCode(1)->first();

        return $concept->name.': '.$month->name.' - '.$month->year->year;
    }

    public function destroy(AnnullmentRequest $request, Affidavit $affidavit)
    {
        if (!$affidavit->liquidation()->exists()) {
            return response()->json([
                'success' => false,
                'message' => '¡La declaración tiene una liquidación asociada!'
            ]);
        }

        $affidavit->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 3
        ]);

        $affidavit->delete();
        $affidavit->fines()->delete();

        return redirect()->back()
            ->with('success', '¡Declaración anulada!');
    }
}
