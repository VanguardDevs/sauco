<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Taxpayer;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\Payment;
use App\Models\Settlement;
use App\Http\Requests\AnnullmentRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class FineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:null.settlements')->only('destroy');
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
        $query = $taxpayer->fines()
            ->orderBy('fines.created_at', 'DESC')
            ->with(['concept:id,name']);

        return DataTables::of($query)
            ->addColumn('formatted_amount', function ($payment) {
                return $payment->formatted_amount;
            })
            ->make(true);
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
        $amount = $concept->calculateAmount();

        $fine = $taxpayer->fines()->create([
            'active' => 1,
            'concept_id' => $concept->id,
            'user_id' => auth()->user()->id,
            'amount' => $amount
        ]);

        return redirect()->route('taxpayer.fines', $taxpayer)
            ->withSuccess('¡Multa aplicada!');
    }

    public function makePayment(Fine $fine)
    {
        if ($fine->payment()->exists()) {
            return redirect()
                ->route('payments.show', $fine->payment()->first());
        }

        $payment = Payment::create([
            'state_id' => 1,
            'user_id' => auth()->user()->id,
            'amount' => $fine->amount,
            'payment_method_id' => 1,
            'invoice_model_id' => 1,
            'payment_type_id' => 1,
            'taxpayer_id' => $fine->taxpayer_id
        ]);

        $fine->settlement()->create([
            'num' => Settlement::newNum(),
            'object_payment' => $fine->concept->name,
            'payment_id' => $payment->id,
            'taxpayer_id' => $fine->taxpayer_id,
            'amount' => $fine->amount
        ]);

        return redirect()->route('payments.show', $payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function show(Fine $fine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fine  $fine
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
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fine $fine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Fine $fine)
    {
        $fine->settlement->delete();
        $fine->delete();

        $fine->nullFine()->create([
            'user_id' => Auth::user()->id,
            'reason' => $request->get('annullment_reason')
        ]);

        $payment = $fine->payment();

        if ($payment->exists()) {
            $payment->first()->updateAmount();
        }

        return redirect()->back()
            ->with('success', '¡Multa anulada!');
    }
}
