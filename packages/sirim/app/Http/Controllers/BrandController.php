<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Brand $brand)
    {
        return view('modules.vehicles.brands.index');
    }

    
    public function list()
    {
        $query = Brand::query();

        return DataTables::eloquent($query)->toJson();
    }


    public function create(Brand $brand)
    {
        return view('modules.vehicles.brands.register')->with('typeForm', 'create');
    }


    public function store(Request $request)
    {
        $brand = Brand::create($request->all());


        return redirect('brands')
            ->withSuccess('¡Marca de vehículo registrada!');
    }



    public function edit(Brand $brand)
    {
        return view('modules.vehicles.brands.register')
            ->with('typeForm', 'update')
            ->with('row', $brand);
    }


    public function update(Request $request, Brand $brand)
    {
        $edit = Brand::find($brand->id);
        $edit->fill($request->all())
            ->save();

        return redirect('brands')
            ->withSuccess('¡Marca de vehículo actualizada!');

    }


    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'success' => '¡Marca de vehículo eliminada!'
        ]);
    }
}
