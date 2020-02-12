<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationState;
use App\Http\Requests\Applications\ApplicationsCreateFormRequest;
use App\Payment;
use App\PaymentState;
use App\PaymentType;
use App\Concept;
use App\EconomicActivityLicense;
use App\Month;
use App\OldLicense;
use App\Ordinance;
use App\Taxpayer;
use App\Settlement;
use App\TaxUnit;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    public function list()
    {
        $query = Application::with([
            'settlement.concept',
            'settlement.taxpayer',
            'applicationState'])->select('applications.*');

        return DataTables::eloquent($query)->toJson();
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
        $ordinance = Ordinance::find($request->input('ordinance'));
        $concept = Concept::find($request->input('concept'));
        $taxpayer = Taxpayer::find($request->input('taxpayer'));

        if ($this->applicationExist($concept, $taxpayer)) {
            return redirect('taxpayers/'.$taxpayer->id)
                ->withError('¡El contribuyente tiene una solicitud activa por este concepto!');
        }

        if ($ordinance->description == 'ACTIVIDAD ECONÓMICA') {
            return $this->verifyEconomicActivityApplication($concept, $taxpayer);
        }

        return $this->storeApplication($taxpayer, $concept);
    }

    public function applicationExist(Concept $concept, Taxpayer $taxpayer)
    {
        $applicationState = ApplicationState::whereDescription('APROBADA')->first();
        $applications = $taxpayer->applications->where('application_state_id', '!=', $applicationState->id);

        if (!empty($applications)) {
            foreach($applications as $application) {
                $settlementConcept = $application->settlement->concept->description;

                if ($settlementConcept == $concept->description) {
                    return true;
                }
            }
        }
        return false;
    }

    public function verifyEconomicActivityApplication(Concept $concept, Taxpayer $taxpayer)
    {
        if ($concept->description == 'SOLICITUD DE RENOVACIÓN DE LICENCIAS DE ACTIVIDADES ECONÓMICAS') {
            if (!EconomicActivityLicense::getLastLicense($taxpayer)) {
                return redirect('taxpayers/'.$taxpayer->id)
                        ->withError('¡El contribuyente no tiene licencia por renovar!');
            } else {
                return $this->storeApplication($taxpayer, $concept);
            }  
        } else if ($concept->description == 'SOLICITUD DE PATENTE DE INDUSTRIA Y COMERCIO') {
            if (EconomicActivityLicense::getLastLicense($taxpayer)) {
                return Session::flash('error', 'El contribuyente tiene una licencia por renovar.');
            } else {
                if (empty($taxpayer->capital)) {
                    return redirect('taxpayers/'.$taxpayer->id)
                        ->withError('¡El contribuyente no tiene asignado su capital!');
                } else {
                    return $this->storeApplication($taxpayer, $concept);
                }
            }
        }
    }

    public function makeSettlement(Taxpayer $taxpayer, Concept $concept)
    {
        /**
         * Make a payment and a settlement
         */
        $payNum = Payment::getNum();
        $settlementNum = Settlement::getNum();

        $month = Month::find(Carbon::now()->month);
        $type = PaymentType::whereDescription('S/N')->first();
        $paymentState = PaymentState::whereDescription('PENDIENTE')->first();
        $month = Month::find(Carbon::now()->month);
        
        $amount = Concept::getAmount($taxpayer, $concept);
        
        $payment = Payment::create([
            'num' => $payNum,
            'amount' => $amount,
            'total_amount' => $amount,
            'payment_state_id' => $paymentState->id,
            'payment_type_id' => $type->id,
            'user_id' => Auth::id()
        ]);

        $settlement = Settlement::create([
            'num' => $settlementNum,
            'amount' => $amount,
            'payment_id' => $payment->id,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => $month->id,
            'concept_id' => $concept->id
        ]);

        return $settlement;
    }

    public function storeApplication(Taxpayer $taxpayer, Concept $concept)
    {
        $applicationNum = Application::getNum();
        $applicationState = ApplicationState::whereDescription('PENDIENTE')->first();
        
        $settlement = $this->makeSettlement($taxpayer, $concept);

        Application::create([
            'num' => $applicationNum,
            'settlement_id' => $settlement->id,
            'application_state_id' => $applicationState->id,
        ]);

        return redirect('taxpayers/'.$settlement->taxpayer_id)
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

        $application = Application::find($id);
        $application->answer_date = Carbon::now();
        $application->application_state_id = $state->id;
        $application->save();

        // Update payment
        $payState = PaymentState::whereDescription('PROCESADA')->first();
        $payment = Payment::find($application->settlement->payment_id);
        $payment->payment_state_id = $payState->id;
        $payment->save();

        return Session::flash('success', '¡Solicitud aprobada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $state = $application->applicationState->description;

        if ($state == 'PROCESADA' || $state == 'APROBADA') {
            return Session::flash('error', '¡La solicitud no puede ser anulada!');
        }

        $settlement = Settlement::find($application->settlement->id);
        $payment = Payment::find($settlement->payment->id);
        $application->delete();
        $settlement->delete();
        $payment->delete();

        return Session::flash('success','¡Solicitud anulada!');
    }
}
