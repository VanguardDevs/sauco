<?php

namespace App\Http\Controllers;

use App\Http\Requests\Properties\PropertiesCreateFormRequest;
use App\OwnershipStatus;
use App\Parish;
use App\Property;
use App\PropertyType;
use App\Taxpayer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PropertyController extends Controller
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
        return view('modules.properties.index');
    }

    public function list()
    {
        $query = Property::query()
            ->with('taxpayer');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $taxpayer = Taxpayer::find($id);

        return view('modules.properties.register')
            ->with('taxpayer', $taxpayer)
            ->with('ownershipStatus', OwnershipStatus::pluck('description', 'id'))
            ->with('propertyTypes', PropertyType::pluck('denomination', 'id'))
            ->with('parishes', Parish::pluck('name', 'id'))
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, PropertiesCreateFormRequest $request)
    {
        $taxpayer = Taxpayer::find($id);

        $property = new Property([
            'local' => $request->input('local'),
            'street' => $request->input('street'),
            'floor' => $request->input('floor'),
            'cadastre_num' => $request->input('local'),
            'contract' => $request->input('contract'),
            'document' => $request->input('document'),
            'ownership_status_id' => $request->input('ownership_status'),
            'taxpayer_id' => $taxpayer->id,
            'community_id' => $request->input('community'),
            'property_type_id' => $request->input('property_type')
        ]);
        $property->save();

        return redirect('taxpayers/'.$taxpayer->id)
            ->withSuccess('¡Inmueble creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
