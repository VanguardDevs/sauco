<?php

namespace App\Http\Controllers;

use App\Settlement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SettlementController extends Controller
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
        return view('modules.cashbox.settlements'); 
    }

    /**
     * Display all null settlements
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNull()
    {
        return view('modules.cashbox.null-settlements');
    }

    /**
     * List all settlements, no matter what view
     */
    public function list(Request $request)
    {
        if (!$request->input('onlyNull')) {
            $query = Settlement::with(['state', 'concept']);
        } else {
            $query = Settlement::onlyTrashed()
                ->with(['concept']);
        }

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
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function show(Settlement $settlement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function edit(Settlement $settlement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settlement $settlement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settlement $settlement)
    {
        //
    }
}
