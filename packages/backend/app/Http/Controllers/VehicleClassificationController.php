<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleClassification;

class VehicleClassificationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = VehicleClassification::withCount('vehicles');
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
        $model = VehicleClassification::create($request->all());

        return response()->json($model, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleClassification  $VehicleClassification
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleClassification $VehicleClassification)
    {
        return response()->json($VehicleClassification, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleClassification  $VehicleClassification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleClassification $VehicleClassification)
    {
        $VehicleClassification->update($request->all());

        return response()->json($VehicleClassification, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleClassification  $VehicleClassification
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleClassification $VehicleClassification)
    {
        $VehicleClassification->delete();

        return response()->json($VehicleClassification, 201);
    }
}
