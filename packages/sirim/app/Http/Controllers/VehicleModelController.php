<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use App\Models\Brand;
use Illuminate\Http\Request;
//use App\Http\Requests\VehicleModels\VehicleModelCreateFormRequest;
use Yajra\DataTables\Facades\DataTables;


class VehicleModelController extends Controller
{
    public function index(VehicleModel $vehicleModel)
    {
        return view('modules.vehicles.models.index');
    }


    public function list()
    {
        $query = VehicleModel::query()->with('brand');

        return DataTables::eloquent($query)->toJson();
    }


    public function create(VehicleModel $vehicleModel)
    {
        return view('modules.vehicles.models.register')
        ->with('brand', Brand::pluck('name', 'id'))
        ->with('vehicleModel', $vehicleModel)
        ->with('typeForm', 'create');
    }


    public function store(Request $request)
    {
        $vehicleModel = VehicleModel::create([
            'name' => $request->input('name'),
            'brand_id' => $request->input('brand')
        ]);

        return redirect('vehicle-models')
            ->withSuccess('¡Modelo de vehículo registrado!');
    }



    public function edit(VehicleModel $vehicleModel)
    {
        return view('modules.vehicles.models.register')
            ->with('brand', Brand::pluck('name', 'id'))
            ->with('typeForm', 'update')
            ->with('row', $vehicleModel);
    }


    public function update(Request $request, VehicleModel $vehicleModel)
    {
        $edit = VehicleModel::find($vehicleModel->id);
        $edit->fill($request->all())
            ->save();

        return redirect('vehicle-models')
            ->withSuccess('¡Modelo de vehículo actualizado!');
    }


    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();

        return response()->json([
            'success' => '¡Modelo de vehículo eliminado!'
        ]);
    }
}
