<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Ordinance;
use App\Models\ChargingMethod;
use App\Models\Listing;
use App\Models\AccountingAccount;
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
        $query = Concept::with(['ordinance', 'chargingMethod']);

        return DataTables::eloquent($query)->toJson();
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
            ->with('accounts', AccountingAccount::pluck('name', 'id'))
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
        $concept = Concept::create($request->input());

        return redirect('settings/concepts')
            ->withSuccess('¡Concepto de recaudación creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function show(Concept $Concept)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function edit(Concept $concept)
    {
        return view('modules.concepts.register')
            ->with('typeForm', 'edit')
            ->with('ordinances', Ordinance::pluck('description', 'id'))
            ->with('chargingMethods', ChargingMethod::pluck('name', 'id'))
            ->with('listings', Listing::pluck('name', 'id'))
            ->with('accounts', AccountingAccount::pluck('name', 'id'))
            ->with('row', $concept);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concept $concept)
    {
        $concept->update($request->input());

        return redirect('settings/concepts')
            ->withSuccess('¡Concepto de recaudación actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concept $Concept)
    {
        //
    }
}
