<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Http\Requests\ApplicationTypes\ApplicationTypesCreateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApplicationTypeController extends Controller
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
        return view('modules.application-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.application-types.register')
            ->with('typeForm', 'create');
    }

    public function list()
    {
        $query = ApplicationType::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationTypesCreateFormRequest $request)
    {
        $create = ApplicationType::create([
            'description' => $request->input('description')
        ]);
        $create->save();

        return redirect('settings/application-types')->withSuccess('¡Tipo de solicitud creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ApplicationType  $applicationType
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicationType $applicationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApplicationType  $applicationType
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationType $applicationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApplicationType  $applicationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationType $applicationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApplicationType  $applicationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationType $applicationType)
    {
        //
    }
}
