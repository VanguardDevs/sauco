<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxUnits\TaxUnitsCreateFormRequest;
use App\Models\TaxUnit;
use Illuminate\Http\Request;

class TaxUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TaxUnit::latest();
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
    public function store(TaxUnitsCreateFormRequest $request)
    {
        $model = TaxUnit::create($request->all());

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaxUnit  $taxUnit
     * @return \Illuminate\Http\Response
     */
    public function show(TaxUnit $taxUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxUnit  $taxUnit
     * @return \Illuminate\Http\Response
     */
    public function update(TaxUnitsCreateFormRequest $request, TaxUnit $taxUnit)
    {
        $taxUnit->update($request->all());

        return $taxUnit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxUnit  $taxUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxUnit $taxUnit)
    {
        $taxUnit->delete();

        return $taxUnit;
    }
}
