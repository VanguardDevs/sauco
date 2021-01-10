<?php

namespace App\Http\Controllers;

use App\Application;
use App\Ordinance;
use App\Concept;
use App\Taxpayer;
use App\Payment;
use App\Liquidation;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.applications.index')
            ->with('taxpayer', $taxpayer)
            ->with('ordinances', Ordinance::pluck('description', 'id'));
    }

    public function list(Taxpayer $taxpayer)
    {
        $query = Application::whereTaxpayerId($taxpayer->id)
            ->orderBy('applications.created_at', 'DESC')
            ->with(['concept:id,name']);

        return $query;
            ->addColumn('pretty_amount', function ($payment) {
                return $payment->pretty_amount;
            })
            ->make(true);
    }

    public function listConcepts(Ordinance $ordinance)
    {
        return $ordinance->concepts()
            ->whereLiquidationTypeId(1)
            ->get();
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
    public function store(Request $request, Taxpayer $taxpayer)
    {
        $concept = Concept::find($request->input('concepts'));
        $amount = $concept->calculateAmount();

        $application = $taxpayer->applications()->create([
            'active' => 1,
            'concept_id' => $request->input('concepts'),
            'user_id' => auth()->user()->id,
            'amount' => $amount
        ]);

        $application->makeLiquidation();

        return redirect()
            ->route('liquidations.index', $application->taxpayer_id)
            ->withSuccess('¡Liquidación realizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
