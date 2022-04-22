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
            ->with(['concept:id,name', 'liquidation']);

        return DataTables::of($query)
            ->addColumn('pretty_amount', function ($q) {
                return $q->pretty_amount;
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
        $concept = Concept::find($request->get('concept'));
        $amount = ($request->amount) ? $request->amount : $concept->calculateAmount();

        $fine = $taxpayer->fines()->create([
            'active' => 1,
            'concept_id' => $concept->id,
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'num' => Fine::getNewNum()
        ]);

        return redirect()->route('taxpayer.fines', $taxpayer)
            ->withSuccess('¡Multa aplicada!');
    }

    public function makePayment(Fine $fine)
    {
        $payment = $fine->mountPayment();

        $liquidation = $fine->makeLiquidation();

        $payment->liquidations()->sync($liquidation);

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
        if ($fine->liquidation()->exists()) {
            return response()->json([
                'success' => false,
                'message' => '¡La multa tiene una liquidación asociada!'
            ]);
        }

        $fine->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 2
        ]);

        $fine->delete();

        return redirect()->back()
            ->with('success', '¡Multa anulada!');
    }
}
