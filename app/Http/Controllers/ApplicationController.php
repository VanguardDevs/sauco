<?php

namespace App\Http\Controllers;

use App\Application;
use App\Ordinance;
use App\TaxUnit;
use App\Concept;
use App\Taxpayer;
use App\Payment;
use App\Settlement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
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
    public function index(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.applications.index')
            ->with('taxpayer', $taxpayer)
            ->with('ordinances', Ordinance::pluck('description', 'id'));
    }

    public function list(Taxpayer $taxpayer)
    {
        $query = Application::whereTaxpayerId($taxpayer->id)
            ->with('concept');

        return DataTables::of($query)
            ->toJson();
    }

    public function listConcepts(Ordinance $ordinance)
    {
        return $ordinance->conceptsByList(1);
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
        $value = TaxUnit::latest()->first()->value;
        $concept = Concept::find($request->input('concepts'));
        $amount = $concept->amount * $value; 

        $application = $taxpayer->applications()->create([
            'active' => 1,
            'concept_id' => $request->input('concepts'),
            'user_id' => auth()->user()->id,
            'amount' => $amount
        ]);

        $payment = $taxpayer->payments()->create([
            'num' => Payment::newNum(),
            'state_id' => 1,
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'payment_method_id' => 1,
            'payment_type_id' => 1,
        ]);

        $application->settlement()->create([
            'num' => Settlement::newNum(),
            'object_payment' => $concept->name,
            'payment_id' => $payment->id,
            'amount' => $amount
        ]);

        return redirect()->route('applications.index', $taxpayer)
            ->withSuccess('¡Solicitud creada!');
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
    public function destroy($id)
    {
        //
    }
}
