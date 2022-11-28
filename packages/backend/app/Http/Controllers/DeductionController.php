<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\AnnullmentRequest;
use Illuminate\Http\Request;
use App\Traits\ReportUtils;
use PDF;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $firstDate = '10-08-2022';
        $secondDate = '11-08-2022';

        $query = Deduction::latest()
            ->whereDate('created_at', '>=', $firstDate)
            ->whereDate('created_at', '<', $secondDate)
            ->whereHas('payment', function ($q) {
                $q->whereStatusId(2);
            });
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('num', $filters)) {
                $query->whereLike('num', $filters['num']);
            }
            if (array_key_exists('amount', $filters)) {
                $query->whereAmount($filters['amount']);
            }
            if (array_key_exists('gt_date', $filters)) {
                $query->whereDate('created_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('created_at', '<', $filters['lt_date']);
            }
        }

        // if ($request->type == 'pdf') {
            return $this->report($query, $firstDate, $secondDate);
        // }

        return $query->paginate($results);
    }

    public function report($query, $date1, $date2)
    {
        // Prepare pdf
        $total = ReportUtils::getTotalFormattedAmount($query, 'amount');
        $deductions = $query->get();
        $dates = $date1.' - '.$date2;
        $title = "Reporte de retenciones";

        $pdf = PDF::LoadView('pdf.reports.deductions', compact([
            'deductions',
            'total',
            'title',
            'dates'
        ]));

        return $pdf->download();
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
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Deduction $deduction)
    {
        $liquidation = $deduction->liquidation;

        if ($liquidation->status_id == 2) {
            return response()->json('La liquidación ya fue procesada', 400);
        }

        $affidavit = $liquidation->liquidable;
        $liquidation->update([
            'amount' => $affidavit->amount
        ]);

        if ($affidavit->fines()->exists()) {
            $concept = Concept::find(3);

            foreach($affidavit->fines as $fine) {
                $amount = $concept->calculateAmount($affidavit->amount);

                $fine->update([
                    'amount' => $amount
                ]);
                $fine->liquidation()->update([
                    'amount' => $amount
                ]);
            }
        }

        $deduction->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 5
        ]);
        $deduction->delete();

        return response()
            ->json('¡Deducción '.$deduction->num.' anulada!', 200);
    }
}
