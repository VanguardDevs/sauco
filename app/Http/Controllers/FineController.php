<?php

namespace App\Http\Controllers;

use App\Fine;
use App\Taxpayer;
use App\Ordinance;
use App\Concept;
use App\Payment;
use App\Settlement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class FineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:destroy.fines')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.fines.index')
            ->with('taxpayer', $taxpayer)
            ->with('ordinances', Ordinance::pluck('description', 'id'));
    }

    public function list(Taxpayer $taxpayer)
    {
        $query = Fine::whereTaxpayerId($taxpayer->id)
            ->with('concept')
            ->get();

        return DataTables::of($query)
            ->toJson();
    }

    public function listConcepts(Ordinance $ordinance)
    {
        return $ordinance->conceptsByList(2);
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
        $concept = Concept::find($request->input('concept'));
        $amount = $request->input('amount'); 

        $fine = $taxpayer->fines()->create([
            'active' => 1,
            'concept_id' => $concept->id,
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

        $fine->settlement()->create([
            'num' => Settlement::newNum(),
            'object_payment' => $concept->name,
            'payment_id' => $payment->id,
            'amount' => $amount
        ]);

        return redirect()->route('fines.index', $taxpayer)
            ->withSuccess('¡Multa aplicada!');
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
        $payment = $fine->payment()->first();

        if ($fine->settlement) {
            $fine->settlement->delete();
            $payment->updateAmount();
        } 
        $fine->delete();

        return redirect()->back()
            ->with('success', '¡Multa anulada!');   
    }
}
