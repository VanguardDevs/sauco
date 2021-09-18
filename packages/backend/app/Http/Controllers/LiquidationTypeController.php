<?php

namespace App\Http\Controllers;

use App\Models\LiquidationType;
use App\Http\Requests\LiquidationTypeCreateRequest;
use Illuminate\Http\Request;

class LiquidationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = LiquidationType::withCount('liquidations');
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
    public function store(LiquidationTypeCreateRequest $request)
    {
        $model = LiquidationType::create($request->all());

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LiquidationType $liquidationType)
    {
        return $liquidationType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LiquidationTypeCreateRequest $request, LiquidationType $liquidationType)
    {
        $liquidationType->update($request->all());

        return response()->json($liquidationType, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiquidationType $liquidationType)
    {
        $liquidationType->delete();

        return response()->json($liquidationType, 200);
    }
}
