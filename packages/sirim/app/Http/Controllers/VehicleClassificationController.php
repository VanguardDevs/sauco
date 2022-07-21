<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleClassification;
use Yajra\DataTables\Facades\DataTables;
use App\Models\VehicleParameter;
use App\Models\ChargingMethod;


class VehicleClassificationController extends Controller
{


    public function index(VehicleClassification $vehicleClassification)
    {
        return view('modules.vehicles.classifications.index');
    }


    public function list()
    {
        $query = VehicleClassification::query()->with('vehicle_parameter', 'charging_method');

        return DataTables::eloquent($query)->toJson();
    }


    public function create(VehicleClassification $vehicleClassification)
    {
        return view('modules.vehicles.classifications.register')
        ->with('vehicleParameter', VehicleParameter::pluck('name', 'id'))
        ->with('chargingMethod', ChargingMethod::pluck('name', 'id'))
        ->with('vehicleClassification', $vehicleClassification)
        ->with('typeForm', 'create');
    }


    public function store(Request $request)
    {
        $vehicleClassification = VehicleClassification::create([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'weight_from' => $request->input('weight_from'),
            'weight_until' => $request->input('weight_until'),
            'stalls_from' => $request->input('stalls_from'),
            'stalls_until' => $request->input('stalls_until'),
            'capacity_from' => $request->input('capacity_from'),
            'capacity_until' => $request->input('capacity_until'),
            'vehicle_parameter_id' => $request->input('vehicleParameter'),
            'charging_method_id' => $request->input('chargingMethod')

        ]);

        return redirect('vehicle-classifications')
            ->withSuccess('¡Clasificación de vehículo registrada!');
    }



    public function edit(VehicleClassification $vehicleClassification)
    {
        return view('modules.vehicles.classifications.register')
            ->with('vehicle_parameter_id', VehicleParameter::pluck('name', 'id'))
            ->with('charging_method_id', ChargingMethod::pluck('name', 'id'))
            ->with('typeForm', 'update')
            ->with('row', $vehicleClassification);
    }


    public function update(Request $request, VehicleClassification $vehicleClassification)
    {
        $classification = VehicleClassification::find($vehicleClassification->id);
        
        $classification->update([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'weight_from' => $request->input('weight_from'),
            'weight_until' => $request->input('weight_until'),
            'stalls_from' => $request->input('stalls_from'),
            'stalls_until' => $request->input('stalls_until'),
            'capacity_from' => $request->input('capacity_from'),
            'capacity_until' => $request->input('capacity_until'),
            'vehicle_parameter_id' => $request->input('vehicle_parameter'),
            'charging_method_id' => $request->input('charging_method')
        ]);

        return redirect('vehicle-classifications')
            ->withSuccess('¡Clasificación de vehículo actualizada!');
    }


    public function destroy(VehicleClassification $vehicleClassification)
    {
        $vehicleClassification->delete();

        return response()->json([
            'success' => '¡Clasificación de vehículo eliminada!'
        ]);
    }

}
