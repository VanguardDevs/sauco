<?php

namespace App\Http\Controllers;

use App\OldLicense;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Taxpayer;

class OldLicenseController extends Controller
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
        return view('modules.old-licenses.index');
    }

    public function list()
    {
        $query = OldLicense::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldLicense  $OldLicense
     * @return \Illuminate\Http\Response
     */
    public function show(OldLicense $OldLicense)
    {
        $taxpayer = Taxpayer::whereRif($OldLicense->rif)->first();

        return view('modules.old-licenses.register')
            ->with('typeForm', 'create')
            ->with('row', $OldLicense)
            ->with('taxpayer', $taxpayer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldLicense  $OldLicense
     * @return \Illuminate\Http\Response
     */
    public function edit(OldLicense $OldLicense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldLicense  $OldLicense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldLicense $OldLicense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldLicense  $OldLicense
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldLicense $OldLicense)
    {
        //
    }
}
