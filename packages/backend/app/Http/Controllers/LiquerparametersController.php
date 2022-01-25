<?php

namespace App\Http\Controllers;

use App\Models\liquerparameters;
use Illuminate\Http\Request;

class LiquerparametersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = LiquerClassification::query();
        $results = $Liquerclasifications->perPage;

        if ($Liquerclasifications->has('filter')) {
            $filters = $Liquerclasifications->filter;

            if (array_key_exists('new_registry_amount', $filters)) {
                $query->whereLike('new_registry_amount', $filters['new_registry_amount']);
            }
            if (array_key_exists('renew_registry_amount', $filters)) {
                $query->whereLike('renew_registry_amount', $filters['renew_registry_amount']);
            }
            if (array_key_exists('movil', $filters)) {
                $query->whereLike('movil', $filters['movil']);
            }
            if (array_key_exists('liquer_classifications_id', $filters)) {
                $query->where('liquer_classifications_id', '=', $filters['liquer_classifications_id']);
            }
            if (array_key_exists('liuer_zone_id', $filters)) {
                $query->where('liuer_zone_id', '=', $filters['liuer_zone_id']);
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
    public function store(liquerparameters $liquerparameters) 
    {
        $liquerparameters = liquerparameters::create($request->all());

        return response()->json($liquerparameters, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\liquerparameters  $liquerparameters
     * @return \Illuminate\Http\Response
     */
    public function show(liquerparameters $liquerparameters)
    {
        return $response->json($liquerparameters, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\liquerparameters  $liquerparameters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, liquerparameters $liquerparameters)
    {
        $liquerparameters->update($request->all());

        return response()->json($liquerparameters, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\liquerparameters  $liquerparameters
     * @return \Illuminate\Http\Response
     */
    public function destroy(liquerparameters $liquerparameters)
    {
        $liquerparameters->delete();

        return response()->json($liquerparameters, 201);
    }
}
