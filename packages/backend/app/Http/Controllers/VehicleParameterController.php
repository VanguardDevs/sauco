<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleParameter;


class VehicleParameterController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = VehicleParameter::query();
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
        $parameter = VehicleParameter::create($request->all());

        return response()->json($parameter, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleParameter  $VehicleParameter
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleParameter $VehicleParameter)
    {
        return response()->json($VehicleParameter, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleParameter  $VehicleParameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleParameter $VehicleParameter)
    {
        $VehicleParameter->update($request->all());

        return response()->json($VehicleParameter, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleParameter  $VehicleParameter
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleParameter $VehicleParameter)
    {
        $VehicleParameter->delete();

        return response()->json($VehicleParameter, 201);
    }
}
