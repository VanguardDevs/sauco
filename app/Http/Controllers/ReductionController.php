<?php

namespace App\Http\Controllers;

use App\Reduction;
use Illuminate\Http\Request;

class ReductionController extends Controller
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
        return view('modules.reductions.index');
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
     * @param  \App\Reduction  $reduction
     * @return \Illuminate\Http\Response
     */
    public function show(Reduction $reduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reduction  $reduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Reduction $reduction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reduction  $reduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reduction $reduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reduction  $reduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reduction $reduction)
    {
        //
    }
}
