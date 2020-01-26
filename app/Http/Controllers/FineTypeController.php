<?php

namespace App\Http\Controllers;

use App\ChargingMethod;
use App\FineType;
use App\Http\Requests\FineTypes\FineTypesCreateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FineTypeController extends Controller
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
        return view('modules.fine-types.index');
    }

    public function list()
    {
        $query = FineType::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.fine-types.register')
            ->with('chargingMethods', ChargingMethod::get())
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FineTypesCreateFormRequest $request)
    {
        $create = new FineType([
            'law' => $request->input('law'),
            'value' => $request->input('value'),
            'publication_date' => $request->input('publication_date'),
            'description' => $request->input('description'),
            'charging_method_id' => $request->input('charging_method')
        ]);
        $create->save();

        return redirect('settings/fine-types')->withSuccess('¡Nuevo tipo de multa creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FineType  $fineType
     * @return \Illuminate\Http\Response
     */
    public function show(FineType $fineType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FineType  $fineType
     * @return \Illuminate\Http\Response
     */
    public function edit(FineType $fineType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FineType  $fineType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FineType $fineType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FineType  $fineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FineType $fineType)
    {
        //
    }
}
