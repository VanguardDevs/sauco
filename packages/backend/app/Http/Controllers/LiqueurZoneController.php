<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiqueurZone;

class LiqueurZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = LiqueurZone::query();
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
        $model = LiqueurZone::create($request->all());

        return response()->json($model, 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(LiqueurZone $LiqueurZone)
    {
        return response()->json($LiqueurZone, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiqueurZone  $LiqueurZone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiqueurZone $LiqueurZone)
    {
        $LiqueurZone->update($request->all());

        return response()->json($LiqueurZone, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiqueurZone  $VehicleUse
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiqueurZone $LiqueurZone)
    {
        $LiqueurZone->delete();

        return response()->json($LiqueurZone, 201);
    }
}
