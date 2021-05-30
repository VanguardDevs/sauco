<?php

namespace App\Http\Controllers;

use App\Models\TaxpayerType;
use Illuminate\Http\Request;

class TaxpayerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TaxpayerType::withCount('taxpayers');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('description', $filters)) {
                $query->whereLike('description', $filters['description']);
            }
        }

        return $query->paginate($results);
    }
}
