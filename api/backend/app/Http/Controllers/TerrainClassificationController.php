<?php

namespace App\Http\Controllers;

use App\Models\TerrainClassification;
use App\Http\Requests\TerrainClassificationValidateRequest;
use Illuminate\Http\Request;

class TerrainClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TerrainClassification::withCount('properties');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
            if (array_key_exists('value', $filters)) {
                $query->whereLike('value', $filters['value']);
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
    public function store(TerrainClassificationValidateRequest $request)
    {
        $terrainClassification = TerrainClassification::create($request->all());

        return $terrainClassification;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TerrainClassification $terrainClassification)
    {
        return $terrainClassification;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TerrainClassificationValidateRequest $request, TerrainClassification $terrainClassification)
    {
        $terrainClassification->update($request->all());

        return $terrainClassification;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TerrainClassification $terrainClassification)
    {
        $terrainClassification->delete();

        return $terrainClassification;
    }
}
