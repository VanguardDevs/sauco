<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleParameter;
use Yajra\DataTables\Facades\DataTables;


class VehicleParameterController extends Controller
{
     public function index(VehicleParameter $vehicleParameter)
     {
         return view('modules.vehicles.parameters.index');
     }


     public function list()
     {
         $query = VehicleParameter::query();

         return DataTables::eloquent($query)->toJson();
     }


     public function create(VehicleParameter $vehicleParameter)
     {

        $boolean = [
            1 => 'Si',
            0 => 'No'
        ];


         return view('modules.vehicles.parameters.register')
         ->with('boolean', $boolean)
         ->with('vehicleParameter', $vehicleParameter)
         ->with('typeForm', 'create');
     }


     public function store(Request $request)
     {
         $vehicleParameter = VehicleParameter::create([
            'name' => $request->input('name'),
            'years' => $request->input('years'),
            'weight' => $request->input('weight'),
            'capacity' => $request->input('capacity'),
            'stalls' => $request->input('stalls')
         ]);

         return redirect('vehicle-parameters')
             ->withSuccess('¡Parámetro de vehículo registrado!');
     }



     public function edit(VehicleParameter $vehicleParameter)
     {

        $boolean = [
            1 => 'Si',
            0 => 'No'
        ];

         return view('modules.vehicles.parameters.register')
            ->with('boolean', $boolean)
            ->with('typeForm', 'update')
            ->with('row', $vehicleParameter);
     }


     public function update(Request $request, VehicleParameter $vehicleParameter)
     {
         $model = VehicleParameter::find($vehicleParameter->id);
         
         $model->update([
            'name' => $request->input('name'),
            'years' => $request->input('years'),
            'weight' => $request->input('weight'),
            'capacity' => $request->input('capacity'),
            'stalls' => $request->input('stalls')
         ]);

         return redirect('vehicle-parameters')
             ->withSuccess('¡Parámetro de vehículo actualizado!');
     }


     public function destroy(VehicleParameter $vehicleParameter)
     {
         $vehicleParameter->delete();

         return response()->json([
             'success' => '¡Parámetro de vehículo eliminado!'
         ]);
     }
}
