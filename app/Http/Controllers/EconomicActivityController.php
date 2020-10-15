<?php

namespace App\Http\Controllers;

use App\ActivityClassification;
use App\EconomicActivity;
use App\Taxpayer;
use App\Http\Requests\Taxpayers\TaxpayerActivitiesFormRequest;
use App\Http\Requests\EconomicActivities\EconomicActivitiesCreateFormRequest;
use App\Http\Requests\EconomicActivities\EconomicActivitiesUpdateFormRequest;

class EconomicActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.role:admin')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.economic-activities.index');
    }

    public function list()
    {
        $query = EconomicActivity::query();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.economic-activities.register')
            ->with('classifications', ActivityClassification::pluck('name', 'id'))
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EconomicActivitiesCreateFormRequest $request)
    {
        $create = EconomicActivity::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'aliquote' => $request->input('aliquote'),
            'min_tax' => $request->input('min_tax'),
            'activity_classification_id' => $request->input('activity_classification_id')
        ]);

        return redirect('economic-activities')
            ->withSuccess('¡Actividad económica registrada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function show(EconomicActivity $economicActivity)
    {
        $taxpayersCount = $economicActivity->getTaxpayers()->count();

        return view('modules.economic-activities.show')
            ->with('row', $economicActivity)
            ->with('numTaxpayers', $taxpayersCount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(EconomicActivity $economicActivity)
    {
        return view('modules.economic-activities.register')
            ->with('classifications', ActivityClassification::pluck('name', 'id'))
            ->with('typeForm', 'update')
            ->with('row', $economicActivity);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\Taxpayer $taxpayer
     * @return \Illuminate\Http\Respose
     */
    public function editActivitiesForm(Taxpayer $taxpayer)
    {
        if (($taxpayer->taxpayerType->description != 'JURÍDICO') &&
            (!$taxpayer->commercialDenomination)) {
                return redirect('taxpayers/'.$taxpayer->id)
                    ->withError('¡Este contribuyente no admite actividades económicas!');
        }

        $activities = EconomicActivity::all()->pluck('fullName','id');

        return view('modules.taxpayers.register-economic-activities')
            ->with('row', $taxpayer)
            ->with('activities', $activities)
            ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function update(EconomicActivitiesFormRequest $request, EconomicActivity $economicActivity)
    {
        $row = EconomicActivity::find($economicActivity->id);
        
        $row->fill($request->all())
            ->save();

        return redirect('economic-activities')
            ->withSuccess('¡Actividad económica actualizada!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxpayer  $taxpayer
     * @return \Illuminate\Http\Response
     */
    public function editActivities(Taxpayer $taxpayer, TaxpayerActivitiesFormRequest $request)
    {
        $taxpayer->economicActivities()->sync(
            $request->input('economic_activities')
        );

        return redirect('taxpayers/'.$taxpayer->id)
            ->withSuccess('¡Actividades económicas actualizadas!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(EconomicActivity $economicActivity)
    {
        $economicActivity->delete();

        return response()->json([
            'success' => '¡Actividad económica eliminada!'
        ]);
    }
}

