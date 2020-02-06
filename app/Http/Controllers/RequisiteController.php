<?php

namespace App\Http\Controllers;

use App\Concept;
use App\Http\Requests\Requisites\RequisitesCreateFormRequest;
use App\Requisite;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RequisiteController extends Controller
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
        return view('modules.requisites.index');
    }

    public function list()
    {
        $query = Requisite::query()
            ->with('concept');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.requisites.register')
            ->with('typeForm', 'create')
            ->with('concepts', Concept::pluck('description', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequisitesCreateFormRequest $request)
    {
        $requisite = new Requisite([
            'description' => $request->input('description'),
            'concept_id' => $request->input('concept')
        ]);
        $requisite->save();

        return redirect('settings/requisites')
            ->with('¡Requisito creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function show(Requisite $requisite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisite $requisite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisite $requisite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisite $requisite)
    {
        //
    }
}
