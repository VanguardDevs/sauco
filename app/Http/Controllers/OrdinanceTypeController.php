<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdinanceTypes\OrdinanceTypesCreateFormRequest;
use App\OrdinanceType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrdinanceTypeController extends Controller
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
        return view('modules.ordinance-types.index');
    }

    public function list()
    {
        $query = OrdinanceType::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.ordinance-types.register')
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdinanceTypesCreateFormRequest $request)
    {
        $create = new OrdinanceType([
            'description' => $request->input('description')
        ]);
        $create->save();

        return redirect('settings/ordinance-types')
            ->withSuccess('¡Nuevo tipo de ordenanza creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdinanceType  $ordinanceType
     * @return \Illuminate\Http\Response
     */
    public function show(OrdinanceType $ordinanceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdinanceType  $ordinanceType
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdinanceType $ordinanceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdinanceType  $ordinanceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdinanceType $ordinanceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdinanceType  $ordinanceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdinanceType $ordinanceType)
    {
        //
    }
}
