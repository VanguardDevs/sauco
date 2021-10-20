<?php

namespace App\Http\Controllers;

use App\Models\Cancellation;
use Illuminate\Http\Request;
use PDF;

class CancellationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Cancellation::with(['type', 'user', 'cancellable.taxpayer'])
            ->orderBy('created_at', 'DESC');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('reason', $filters)) {
                $query->whereLike('reason', $filters['reason']);
            }
            if (array_key_exists('cancellation_type_id', $filters)) {
                $query->where('cancellation_type_id', '=', $filters['cancellation_type_id']);
            }
            if (array_key_exists('gt_date', $filters)) {
                $query->whereDate('created_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('created_at', '<', $filters['lt_date']);
            }
        }

        if ($request->type == 'pdf') {
            return $this->report($query);
        }

        return $query->paginate($results);
    }

    public function report($query)
    {
        // Prepare pdf
        $models = $query->get();
        $pdf = PDF::LoadView('pdf.cancellations', compact(['models']));

        return $pdf->download('reporte.pdf');
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
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function show(Cancellation $cancellation)
    {
        $data = $cancellation->load('type', 'user', 'cancellable.taxpayer');

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancellation $cancellation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cancellation $cancellation)
    {
        //
    }
}
