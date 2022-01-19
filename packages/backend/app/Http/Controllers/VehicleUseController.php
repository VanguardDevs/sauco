<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleUse;

class VehicleUseController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = VehicleUse::withCount('vehicles');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
        }

        return $query->paginate($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = VehicleUse::create($request->all());

        return response()->json($model, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleUse  $VehicleUse
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleUse $VehicleUse)
    {
        return response()->json($VehicleUse, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleUse  $VehicleUse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleUse $VehicleUse)
    {
        $VehicleUse->update($request->all());

        return response()->json($VehicleUse, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleUse  $VehicleUse
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleUse $VehicleUse)
    {
        $VehicleUse->delete();

        return response()->json($VehicleUse, 201);
    }
    //
}
