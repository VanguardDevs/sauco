<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\License;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $query = License::where('ordinance_id', '4');


        // Return responses
        if ($request->wantsJson()) {
            $query->with(['taxpayer', 'ordinance']);

            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.vehicles.settings.index');


        /*$query = Vehicle::orderBy('active', 'ASC');

        // Return responses
        if ($request->wantsJson()) {
            $query->with(['taxpayer', 'vehicle_classification', 'vehicle_model', 'color']);

            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.vehicles.settings.index');*/
    }


    public function listBytaxpayer(Taxpayer $taxpayer)
    {
        $query = License::whereTaxpayerId($taxpayer->id);

    	return DataTables::eloquent($query)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());

        return response()->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
