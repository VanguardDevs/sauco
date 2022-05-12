<?php

namespace App\Http\Controllers;

use App\Models\CorrelativeType;
use Illuminate\Http\Request;

class CorrelativeTypeController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CorrelativeType::query();
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
    public function store(Request $request)
    {
        $correlativeType = CorrelativeType::create($request->all());

        return response()->json($correlativeType, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CorrelativeType  $correlativeType
     * @return \Illuminate\Http\Response
     */
    public function show(CorrelativeType $correlativeType)
    {
        return $correlativeType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CorrelativeType  $correlativeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CorrelativeType $correlativeType)
    {
        $correlativeType->update($request->all());

        return response()->json($correlativeType, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CorrelativeType  $correlativeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CorrelativeType $correlativeType)
    {
        $correlativeType->delete();

        return response()->json($correlativeType, 201);
    }
}
