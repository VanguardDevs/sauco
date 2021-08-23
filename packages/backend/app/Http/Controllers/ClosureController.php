<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClosureController extends Controller
{
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

        if ($request->has('filter')) {
            $filters = $request->filter;

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
        }

        return $query->paginate($results);
    }
}
