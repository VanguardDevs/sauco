<?php

namespace App\Http\Controllers;

use App\CorrelativeNum;
use App\Correlative;
use App\CorrelativeType;
use App\License;
use App\FiscalYear;
use App\Taxpayer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('modules.economic-activity-licenses.index');
    }

    public function list()
    {
        $query = License::query()
		    ->with('taxpayer');

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
    public function store(Request $request, License $license)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function show($License, $taxpayer)
    {
        //
    }

    public function download(License $license)
    {
        dd($license);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function edit(License $License)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $License)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $License)
    {
        //
    }
}
