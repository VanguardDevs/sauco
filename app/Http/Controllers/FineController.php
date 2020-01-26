<?php

namespace App\Http\Controllers;

use App\Fine;
use App\FineState;
use App\Http\Requests\Fines\FinesCreateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.fines.index');
    }

    public function list()
    {
        $query = Fine::query()
            ->with('fineState')
            ->with('fineType')
            ->with('taxpayer')
            ->orderBy('created_at', 'DESC');

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

    public function addFineTaxpayer(FinesCreateFormRequest $request)
    {
        // dd($request->input());
        $state = FineState::whereDescription('PENDIENTE')->first();
        $user = Auth::user();
        // dd($request->input());
        // Remember to use Laravel has Many through for Properties, Vehicles, Etc
        $fine = new Fine([
            'observations' => $request->input('description'),
            'fine_type_id' => $request->input('fine_type'),
            'fine_state_id' => $state->id,
            'user_id' => $user->id,
            'taxpayer_id' => $request->input('taxpayer')
        ]);
        $fine->save();

        return redirect('taxpayers/'.$request->input('taxpayer'))->withSuccess('¡Multa aplicada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function show(Fine $fine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function edit(Fine $fine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fine $fine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fine $fine)
    {
        $fine->delete();
    }
}
