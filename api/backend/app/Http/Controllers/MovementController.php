<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Concept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Movement::latest();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('own_income', $filters)) {
                $query->whereLike('own_income', $filters['own_income']);
            }
            if (array_key_exists('amount', $filters)) {
                $query->whereLike('amount', $filters['amount']);
            }
            if (array_key_exists('concurrent', $filters)) {
                $query->whereLike('concurrent', $filters['concurrent']);
            }
            if (array_key_exists('taxpayer_id', $filters)) {
                $query->where('taxpayer_id', '=', $filters['taxpayer_id']);
            }
            if (array_key_exists('concept_id', $filters)) {
                $query->where('concept_id', '=', $filters['concept_id']);
            }
            if (array_key_exists('year_id', $filters)) {
                $query->where('year_id', '=', $filters['year_id']);
            }
            if (array_key_exists('concept_id', $filters)) {
                $query->where('concept_id', '=', $filters['concept_id']);
            }
            if (array_key_exists('payment_id', $filters)) {
                $query->where('payment_id', '=', $filters['payment_id']);
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
}
