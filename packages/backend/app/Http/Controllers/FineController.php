<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Taxpayer;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\Payment;
use App\Models\Liquidation;
use App\Http\Requests\AnnullmentRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class FineController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:null.settlements')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Fine::orderBy('num', 'ASC')
            ->with(['concept', 'taxpayer']);
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('num', $filters)) {
                $query->whereLike('num', $filters['num']);
            }
            if (array_key_exists('taxpayer', $filters)) {
                $query->whereHas('taxpayer', function ($q) use ($filters) {
                    $query->whereLike('taxpayer', $filters['taxpayer']);
                });
            }
            if (array_key_exists('amount', $filters)) {
                $query->whereLike('amount', $filters['amount']);
            }
            if (array_key_exists('concept_id', $filters)) {
                $query->where('concept_id', '=', $filters['concept_id']);
            }
            if (array_key_exists('taxpayer_id', $filters)) {
                $query->where('taxpayer_id', '=', $filters['taxpayer_id']);
            }
            if (array_key_exists('gt_date', $filters)) {
                $query->whereDate('created_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('created_at', '<', $filters['lt_date']);
            }
        }

        return $query->paginate($results);
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

        $fine->makeLiquidation();

        return redirect()->route('liquidations.index', $taxpayer)
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

        $liquidation = $fine->liquidation()->create([
            'num' => Liquidation::getNewNum(),
            'object_payment' => $fine->concept->name,
            'concept_id' => $fine->concept->id,
            'taxpayer_id' => $fine->taxpayer_id,
            'user_id' => auth()->user()->id,
            'amount' => $fine->amount
        ]);

        $payment->liquidations()->sync($liquidation);

        return redirect()->route('payments.show', $payment);
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
        if ($fine->liquidation()->exists()) {
            return response()
                ->json('¡La multa tiene una liquidación asociada!', 400);
        }

        $fine->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 2
        ]);

        $fine->delete();

        return response()->json('¡Multa '.$fine->num.' anulada!', 200);
    }
}
