<?php

namespace App\Http\Controllers;

use App\ChargingMethod;
use App\Http\Requests\PropertyTypes\PropertyTypesCreateFormRequest;
use App\Http\Requests\PropertyTypes\PropertyTypesUpdateFormRequest;
use App\PropertyType;
use Yajra\DataTables\Facades\DataTables;

class PropertyTypeController extends Controller
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
        return view('modules.property-types.index');
    }

    public function list()
    {
        $query = PropertyType::query()
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
        return view('modules.property-types.register')
            ->with('chargingMethods', ChargingMethod::pluck('name', 'id'))
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyTypesCreateFormRequest $request)
    {
        $create = new PropertyType([
            'classification' => $request->input('classification'),
            'denomination' => $request->input('denomination'),
            'amount' => $request->input('amount'),
            'charging_method_id' => $request->input('charging_method')
        ]);
        $create->save();

        return redirect('settings/property-types')->withSuccess('¡Creado nuevo tipo de inmueble!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyType $propertyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyType $propertyType)
    {
        return view('modules.property-types.register')
            ->with('row', $propertyType)
            ->with('chargingMethods', ChargingMethod::pluck('name', 'id'))
            ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyTypesUpdateFormRequest $request, PropertyType $propertyType)
    {
        $edit = PropertyType::find($propertyType->id);
        $edit->fill($request->all())->save();

        return redirect('settings/property-types')->withSuccess('¡Clasificación actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyType $propertyType)
    {
        //
    }
}
