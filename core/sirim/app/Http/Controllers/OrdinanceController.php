<?php

namespace App\Http\Controllers;

use App\Ordinance;
use App\Http\Requests\Ordinances\OrdinancesCreateFormRequest;
use App\Http\Requests\Ordinances\OrdinancesUpdateFormRequest;
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
        $query = Ordinance::query();

        return DataTables::eloquent($query)->toJson();
    }

    public function listAll()
    {
        return Ordinance::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.ordinances.register')
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
        $create = new Ordinance([
            'description' => $request->input('description')
        ]);
        $create->save();

        return redirect('settings/ordinances')
            ->withSuccess('¡Nuevo tipo de ordenanza creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ordinance  $Ordinance
     * @return \Illuminate\Http\Response
     */
    public function show(Ordinance $Ordinance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ordinance  $Ordinance
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordinance $Ordinance)
    {
        return view('modules.ordinances.register')
            ->with('typeForm', 'update')
            ->with('row', $Ordinance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordinance  $Ordinance
     * @return \Illuminate\Http\Response
     */
    public function update(OrdinancesUpdateFormRequest $request, Ordinance $Ordinance)
    {
        $edit = Ordinance::find($Ordinance->id);
        $edit->description = $request->input('description');
        $edit->save();

        return redirect('settings/ordinances')
            ->withSuccess('¡Ordenanza actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ordinance  $Ordinance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordinance $Ordinance)
    {
        //
    }
}
