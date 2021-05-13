<?php

namespace App\Http\Controllers;

use App\Models\Taxpayer;
use App\Models\Liquidation;
use App\Models\CanceledLiquidation;
use App\Models\Concept;
use App\Models\Month;
use Illuminate\Http\Request;
use App\Http\Requests\AnnullmentRequest;
use Auth;

class LiquidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Liquidation::latest()
            ->with(['taxpayer', 'liquidationType']);
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('num', $filters)) {
                $query->whereLike('num', $filters['num']);
            }
            if (array_key_exists('object_payment', $filters)) {
                $query->whereLike('object_payment', $filters['object_payment']);
            }
            if (array_key_exists('amount', $filters)) {
                $query->whereAmount($filters['amount']);
            }
            if (array_key_exists('taxpayer', $filters)) {
                $name = $filters['taxpayer'];

                $query->whereHas('taxpayer', function ($q) use ($name) {
                    return $q->whereLike('name', $name);
                });
            }
            if (array_key_exists('status_id', $filters)) {
                $query->whereStatusId($filters['status_id']);
            }
            if (array_key_exists('gt_date', $filters)) {
                $query->whereDate('created_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('created_at', '<', $filters['lt_date']);
            }
            if (array_key_exists('liquidation_type_id', $filters)) {
                $name = $filters['liquidation_type_id'];

                if (array_key_exists('liquidation_type_id', $filters)) {
                    $query->where('liquidation_type_id', '=', $filters['liquidation_type_id']);
                }
            }
        }

        return $query->paginate($results);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liquidation  $liquidation
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidation $liquidation)
    {
        return response()->json($liquidation->load([
            'taxpayer',
            'status',
            'liquidationType',
            'liquidable'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidation  $liquidation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidation $liquidation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liquidation  $liquidation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Liquidation $liquidation)
    {
        $liquidation->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 6
        ]);
        $liquidation->delete();

        // Soft delete current liquidable and deduction if exists
        if ($liquidation->deduction()->exists()) {
            $liquidation->deduction()->delete();
        }
        $liquidation->liquidable()->delete();

        return response()
            ->json(['message' => '¡Anulación del registro '.$liquidation->num.' exitosa!'], 200);
    }
}
