<?php

namespace App\Http\Controllers;

use App\Models\PropertyUse;
use Illuminate\Http\Request;

class PropertyUseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PropertyUse::latest();
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
    public function store(Request $request)
    {
        $model = PropertyUse::create($request->all());

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyUse  $propertyUse
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyUse $propertyUse)
    {
        return $propertyUse;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyUse  $propertyUse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyUse $propertyUse)
    {
        $propertyUse->update($request->all());

        return $propertyUse;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyUse  $propertyUse
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyUse $propertyUse)
    {
        $propertyUse->delete();

        return $propertyUse;
    }
}
