<?php

namespace App\Http\Controllers;

use App\EconomicActivity;
use App\Http\Requests\EconomicActivities\EconomicActivitiesCreateFormRequest;
use App\Http\Requests\EconomicActivities\EconomicActivitiesUpdateFormRequest;
use Yajra\DataTables\Facades\DataTables;

class EconomicActivityController extends Controller
{
    public function __construct()
    {
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

        return DataTables::eloquent($query)->toJson();
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
    public function store(EconomicActivitiesCreateFormRequest $request)
    {
        $create = new EconomicActivity([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'aliquote' => $request->input('aliquote'),
            'min_tax' => $request->input('min_tax')
        ]);
        $create->save();

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
        //
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
            ->with('typeForm', 'update')
            ->with('row', $economicActivity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function update(EconomicActivitiesUpdateFormRequest $request, EconomicActivity $economicActivity)
    {
        $row = EconomicActivity::find($economicActivity->id);
        $row->fill($request->all())
            ->save();

        return redirect('economic-activities')
            ->withSuccess('¡Actividad económica actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(EconomicActivity $economicActivity)
    {
        //
    }
}
