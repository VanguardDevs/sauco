<?php

namespace App\Http\Controllers;

use App\CanceledLiquidation;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CanceledLiquidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = CanceledLiquidation::orderBy('canceled_liquidations.created_at', 'DESC')
                    ->with(['taxpayer', 'status', 'liquidation', 'user', 'liquidationType']);

            return DataTables::of($query)->toJson();
        }

        return view('modules.reports.canceled-liquidations');
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
     * @param  \App\CanceledLiquidation  $canceledLiquidation
     * @return \Illuminate\Http\Response
     */
    public function show(CanceledLiquidation $canceledLiquidation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CanceledLiquidation  $canceledLiquidation
     * @return \Illuminate\Http\Response
     */
    public function edit(CanceledLiquidation $canceledLiquidation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CanceledLiquidation  $canceledLiquidation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CanceledLiquidation $canceledLiquidation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CanceledLiquidation  $canceledLiquidation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanceledLiquidation $canceledLiquidation)
    {
        //
    }
}
