<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = VehicleModel::withCount('brand');
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
        $vehicleModel = VehicleModel::create($request->all());

        return response()->json($vehicleModel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleModel $vehicleModel)
    {
        return $vehicleModel;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleModel $vehicleModel)
    {
        $vehicleModel->update($request->all());

        return response()->json($vehicleModel, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();

        return response()->json($vehicleModel, 201);
    }
}
