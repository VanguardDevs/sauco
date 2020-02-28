<?php

namespace App\Http\Controllers;

use App\ConceptPrice;
use App\Concept;
use App\Ordinance;
use App\ChargingMethod;
use App\Listing;
use App\Http\Requests\Concepts\ConceptsCreateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ConceptController extends Controller
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
        return view('modules.concepts.index');
    }

    public function list()
    {
        $query = Concept::query()
            ->with('conceptPrices');

        return DataTables::eloquent($query)->toJson();
    }

    public function byOrdinance($id)
    {
        $query = Concept::whereOrdinanceId($id);

        return $query->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.concepts.register')
            ->with('ordinances', Ordinance::pluck('description', 'id'))
            ->with('listings', Listing::pluck('name', 'id'))
            ->with('chargingMethods', ChargingMethod::pluck('name', 'id'))
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConceptsCreateFormRequest $request)
    {
        $concept = Concept::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'law' => $request->input('law'),
            'observations' => $request->input('observations'),
            'ordinance_id' => $request->input('ordinance'),
            'list_id' => $request->input('list')
        ]);
        /**
        if ($concept->code != 1) { 
            ConceptPrice::create([
                'value' => $request->input('value'),
                'concept_id' => $concept->id,
                'charging_method_id' => $request->input('charging_method')
            ]);
        } */

        return redirect('settings/concepts')
            ->withSuccess('¡Concepto de recaudación creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function show(Concept $Concept)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function edit(Concept $concept)
    {
        return view('modules.concepts.register')
            ->with('typeForm', 'update')
            ->with('ordinances', Ordinance::pluck('description', 'id'))
            ->with('chargingMethods', ChargingMethod::pluck('name', 'id'))
            ->with('listings', Listing::pluck('name', 'id'))
            ->with('row', $concept);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concept $Concept)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concept $Concept)
    {
        //
    }
}
