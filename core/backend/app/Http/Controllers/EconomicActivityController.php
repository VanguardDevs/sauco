<?php

namespace App\Http\Controllers;

use App\Models\EconomicActivity;
use App\Models\Taxpayer;
use App\Http\Requests\Taxpayers\TaxpayerActivitiesFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\EconomicActivitiesCreateRequest;

class EconomicActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create.economic-activities')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = EconomicActivity::query();

            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.economic-activities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.economic-activities.register')
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EconomicActivitiesCreateRequest $request)
    {
        $create = EconomicActivity::create($request->all());

        return redirect('economic-activities')
            ->withSuccess('¡Actividad económica guardada!');
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
    public function update(EconomicActivitiesCreateRequest $request, EconomicActivity $economicActivity)
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

	if ($taxpayer->licenses()->exists()) {
	    $taxpayer->licenses()->first()->economicActivities()->sync($request->input('economic_activities'));
	}

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
