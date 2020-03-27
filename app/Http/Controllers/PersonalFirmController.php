<?php

namespace App\Http\Controllers;

use App\PersonalFirm;
use Illuminate\Http\Request;
use App\Http\Requests\PersonalFirms\PersonalFirmsCreateFormRequest;
use Yajra\DataTables\Facades\DataTables;

class PersonalFirmController extends Controller
{
    public function __constructor()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.personal-firms.index');
    }
    
    public function list()
    {
        $query = PersonalFirm::query()
            ->orderBy('chargue', 'ASC');
        
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
    public function store(PersonalFirmsCreateFormRequest $request)
    {
        /**
        PersonalFirm::create([
            $request->input(
        ]);
        **/
        return redirect('settings/personal-firms')
           ->withSuccess('¡Firma personal creada!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalFirm  $personalFirm
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalFirm $personalFirm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalFirm  $personalFirm
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalFirm $personalFirm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalFirm  $personalFirm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalFirm $personalFirm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalFirm  $personalFirm
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalFirm $personalFirm)
    {
        //
    }
}
