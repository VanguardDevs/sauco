<?php

namespace App\Http\Controllers;

use App\Representation;
use App\Taxpayer;
use Illuminate\Http\Request;
use App\Citizenship;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Taxpayer $taxpayer)
    {
        if ($taxpayer->taxpayerType->description != 'JURÍDICO') {
            return redirect('taxpayers/'.$taxpayer->id)
                ->withError('¡Este contribuyente no admite un representante!');
        }

        return view('modules.representations.register')
            ->with('citizenships', Citizenship::pluck('description', 'id'))
            ->with('taxpayer', $taxpayer)
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Taxpayer $taxpayer)
    {
        dd($request->input());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function show(Representation $Representation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function edit(Representation $Representation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Representation $Representation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Representation  $Representation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representation $Representation)
    {
        //
    }
}
