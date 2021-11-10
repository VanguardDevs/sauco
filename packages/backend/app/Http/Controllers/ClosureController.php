<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Traits\ReportUtils;
use App\Models\Movement;
use DateTime;

class ClosureController extends Controller
{
    use ReportUtils;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = DB::table('concepts')
            ->select(
                DB::raw('CONCAT(concepts.id || CAST(concurrent AS varchar)) AS id'),
                'concepts.name AS name',
                'concurrent',
                DB::raw('COUNT(movements.id) AS movements_count'),
                DB::raw('SUM(movements.amount) AS amount')
            )
            ->join('movements', 'movements.concept_id', '=', 'concepts.id')
            ->groupBy('concurrent', 'concepts.id')
            ->whereNull('movements.deleted_at')
            ->orderBy('concepts.id', 'ASC');

        $results = $request->perPage ?? 10;

        $filters = $request->has('filter') ? $request->filter : [];

        if (array_key_exists('gt_date', $filters)) {
            $query->whereDate('movements.created_at', '>=', $filters['gt_date']);
        }
        if (array_key_exists('lt_date', $filters)) {
            $query->whereDate('movements.created_at', '<', $filters['lt_date']);
        }
        if (array_key_exists('concept', $filters)) {
            $name = $filters['concept'];

            $query->where('concepts.name', 'ILIKE', "%{$name}%");
        }

        if ($request->type == 'pdf') {
            return $this->report($query, $filters);
        }

        return $query->paginate($results);
    }

    public function report($query, $filters = [])
    {
        // Prepare pdf
        $models = $query->get();
        $total = ReportUtils::getTotalFormattedAmount($models, 'amount');
        $title = "Cierre";

        if (array_key_exists('gt_date', $filters)) {
            $startDate = Date('d/m/Y', strtotime($filters['gt_date']));
        } else {
            $startDate = DateTime::createFromFormat(
                "d/m/Y h:i",
                Movement::first()->created_at
            )->format("d/m/Y");
        }
        if (array_key_exists('lt_date', $filters)) {
            $endDate = Date('d/m/Y', strtotime($filters['lt_date']));
        } else {
            $endDate = DateTime::createFromFormat(
                "d/m/Y h:i",
                Movement::orderBy('created_at', 'desc')->first()->created_at
            )->format("d/m/Y");
        }

        $pdf = PDF::LoadView('pdf.reports.closures', compact([
            'models',
            'title',
            'total',
            'startDate',
            'endDate'
        ]));

        return $pdf->download();
    }
}
