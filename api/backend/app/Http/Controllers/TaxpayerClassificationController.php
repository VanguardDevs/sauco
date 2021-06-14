<?php

namespace App\Http\Controllers;

use App\Models\TaxpayerClassification;
use Illuminate\Http\Request;

class TaxpayerClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TaxpayerClassification::withCount('taxpayers');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxpayerClassification  $taxpayerClassification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxpayerClassification $taxpayerClassification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxpayerClassification  $taxpayerClassification
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxpayerClassification $taxpayerClassification)
    {
        //
    }
}
