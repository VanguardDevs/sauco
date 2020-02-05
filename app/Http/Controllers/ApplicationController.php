<?php

namespace App\Http\Controllers;

use App\Application;
use App\Http\Requests\Applications\ApplicationsCreateFormRequest;
use App\Payment;
use App\PaymentState;
use App\PaymentType;
use App\Concept;
use App\Month;
use App\Taxpayer;
use App\Settlement;
use App\TaxUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    public function __construct(Payment $payment)
    {
        $this->middleware('auth');
        $this->payment = $payment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.applications.index');
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

    public function addApplicationTaxpayer(Request $request)
    {
        /**
         * Step 1: Look for settlement and payment num
         */
        if (Payment::lastPayment()->count()) {
            $lastNum = Payment::lastPayment()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $payNum = str_pad($newNum,8,"0",STR_PAD_LEFT);
        } else {
            $payNum = "00000001";
        }

        if (Settlement::lastSettlement()->count()) {
            $lastNum = Settlement::lastSettlement()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $settlementNum = str_pad($newNum,8,"0",STR_PAD_LEFT);
        } else {
            $settlementNum = "00000001";
        }

        /**
         * Step 2: Look for data
         */
        $concept = Concept::find($request->input('concept'));
        $state = PaymentState::whereDescription('PENDIENTE')->first();
        $type = PaymentType::whereDescription('S/N')->first();
        $taxpayer = Taxpayer::find($request->input('taxpayer'));
        $month = Month::find(Carbon::now()->month);
        $currentUT = TaxUnit::latest()->first();

        /**
         * Step 3: Check if concept is for Economic Activity License OR has charging Method as U.T
         */
        if ($concept->chargingMethod->name == 'U.T' && $currentUT->value) {
            $amount = $concept->value * $currentUT->value;
        } elseif ($concept->description == 'SOLICITUD DE PATENTE DE INDUSTRIA Y COMERCIO') {
            $amount = $taxpayer->capital * $concept->value;
        } else {
            return redirect()->back()->withError('¡Error!');
        }

        /**
         * Make a payment
         */
        $payment = Payment::create([
            'num' => $payNum,
            'amount' => $amount,
            'total_amount' => $amount,
            'payment_state_id' => $state->id,
            'payment_type_id' => $type->id,
            'user_id' => Auth::id()
        ]);

        /**
         * Make a settlement
         */
        $settlement = new Settlement([
            'num' => $settlementNum,
            'amount' => $amount,
            'payment_id' => $payment->id,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => $month->id,
            'concept_id' => $concept->id
        ]);
        $settlement->save();

        return redirect('taxpayers/'.$request->input('taxpayer'))
            ->withSuccess('¡Solicitud enviada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    public function approve($id)
    {
        $state = ApplicationState::whereDescription('APROBADA')->first();

        $update = Application::find($id);
        $update->answer_date = Carbon::now();
        $update->application_state_id = $state->id;
        $update->save();

        return redirect('applications')->withSuccess('¡Solicitud aprobada!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();
    }
}
