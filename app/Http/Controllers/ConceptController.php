<?php

namespace App\Http\Controllers;

use App\Ordinance;
use App\OrdinanceType;
use App\ChargingMethod;
use App\Http\Requests\Ordinances\OrdinancesCreateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrdinanceController extends Controller
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
        return view('modules.ordinances.index');
    }

    public function list()
    {
        $query = Ordinance::query()
            ->with('chargingMethod');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.ordinances.register')
            ->with('ordinanceTypes', OrdinanceType::pluck('description', 'id'))
            ->with('chargingMethods', ChargingMethod::pluck('name', 'id'))
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdinancesCreateFormRequest $request)
    {
        // dd($request->input());
        $create = new Ordinance([
            'law' => $request->input('law'),
            'value' => $request->input('value'),
            'description' => $request->input('description'),
            'publication_date' => $request->input('publication_date'),
            'ordinance_type_id' => $request->input('ordinance_type'),
            'charging_method_id' => $request->input('charging_method')
        ]);
        $create->save();

        return redirect('settings/ordinances')
            ->withSuccess('¡Ordenanza creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ordinance  $ordinance
     * @return \Illuminate\Http\Response
     */
    public function show(Ordinance $ordinance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ordinance  $ordinance
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordinance $ordinance)
    {
        return view('modules.ordinances.register')
            ->with('typeForm', 'update')
            ->with('row', $ordinance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordinance  $ordinance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordinance $ordinance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ordinance  $ordinance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordinance $ordinance)
    {
        //
    }
}
