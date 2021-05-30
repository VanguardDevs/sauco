<?php

namespace App\Http\Controllers;

use App\Models\Ordinance;
use Illuminate\Http\Request;
use App\Http\Requests\OrdinancesCreateRequest;

class OrdinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Ordinance::withCount('concepts');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('description', $filters)) {
                $query->whereLike('description', $filters['description']);
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
    public function store(OrdinancesCreateRequest $request)
    {
        $model = Ordinance::create($request->all());

        return $model;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordinance  $Ordinance
     * @return \Illuminate\Http\Response
     */
    public function update(OrdinancesCreateRequest $request, Ordinance $ordinance)
    {
        $ordinance->update($request->all());

        return $ordinance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ordinance  $Ordinance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordinance $ordinance)
    {
        $ordinance->delete();

        return $ordinance;
    }
}
