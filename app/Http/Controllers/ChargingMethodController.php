<?php

namespace App\Http\Controllers;

use App\ChargingMethod;
use App\Http\Requests\ChargingMethods\ChargingMethodsCreateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ChargingMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.charging-methods.index');
    }

    public function list()
    {
        $query = ChargingMethod::query()->orderBy('created_at', 'DESC');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.charging-methods.register')
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChargingMethodsCreateFormRequest $request)
    {
        $create = new ChargingMethod([
            'name' => $request->input('name')
        ]);
        $create->save();

        return redirect('settings/charging-methods')
            ->withSuccess('¡Creado nuevo método de cobro!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChargingMethod  $chargingMethod
     * @return \Illuminate\Http\Response
     */
    public function show(ChargingMethod $chargingMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChargingMethod  $chargingMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(ChargingMethod $chargingMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChargingMethod  $chargingMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChargingMethod $chargingMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChargingMethod  $chargingMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChargingMethod $chargingMethod)
    {
        //
    }
}
