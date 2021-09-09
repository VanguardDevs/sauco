<?php

namespace App\Http\Controllers;

use App\Models\EconomicActivity;
use App\Models\Taxpayer;
use App\Http\Requests\Taxpayers\TaxpayerActivitiesFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\EconomicActivitiesCreateRequest;

class EconomicActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = EconomicActivity::withCount('taxpayers');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
            if (array_key_exists('code', $filters)) {
                $query->whereLike('code', $filters['code']);
            }
            if (array_key_exists('lt_min_tax', $filters)) {
                $query->where('min_tax', '<', $filters['lt_min_tax']);
            }
            if (array_key_exists('gt_min_tax', $filters)) {
                $query->where('min_tax', '>=', $filters['gt_min_tax']);
            }
            if (array_key_exists('gt_aliquote', $filters)) {
                $query->where('aliquote', '>=', $filters['gt_aliquote']);
            }
            if (array_key_exists('lt_aliquote', $filters)) {
                $query->where('aliquote', '<', $filters['lt_aliquote']);
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
    public function store(EconomicActivitiesCreateRequest $request)
    {
        $act = EconomicActivity::create($request->all());

        return response()->json($act, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function show(EconomicActivity $economicActivity)
    {
        $data = $economicActivity->getTaxpayers()->count();

        return response()->json($data, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function update(EconomicActivitiesCreateRequest $request, EconomicActivity $economicActivity)
    {
        $economicActivity->update($request->all());

        return response()->json($economicActivity, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EconomicActivity  $economicActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(EconomicActivity $economicActivity)
    {
        $economicActivity->delete();

        return response()->json([
            'success' => '¡Actividad económica eliminada!'
        ]);
    }
}
