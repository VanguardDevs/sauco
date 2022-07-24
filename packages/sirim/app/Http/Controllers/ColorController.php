<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ColorController extends Controller
{

    public function index(Color $color)
    {
        return view('modules.vehicles.colors.index');
    }


    public function list()
    {
        $query = Color::query();

        return DataTables::eloquent($query)->toJson();
    }


    public function create(Color $color)
    {
        return view('modules.vehicles.colors.register')->with('color', $color)->with('typeForm', 'create');
    }


    public function store(Request $request)
    {
        $color = Color::create($request->all());


        return redirect('colors')
            ->withSuccess('¡Color de vehículo registrado!');
    }



    public function edit(Color $color)
    {
        return view('modules.vehicles.colors.register')
            ->with('typeForm', 'update')
            ->with('row', $color);
    }


    public function update(Request $request, Color $color)
    {
        $edit = Color::find($color->id);
        $edit->fill($request->all())
            ->save();

        return redirect('colors')
            ->withSuccess('¡Color de vehículo actualizado!');

    }


    public function destroy(Color $color)
    {
        $color->delete();

        return response()->json([
            'success' => '¡Color de vehículo eliminado!'
        ]);
    }

}
