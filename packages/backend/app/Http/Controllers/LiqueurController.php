<?php

namespace App\Http\Controllers;

use App\Models\Liqueur;
use Illuminate\Http\Request;

class LiqueurController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Liqueur::query();
        $results = $request->perPage;

        // if ($request->has('filter')) {
        //     $filters = $request->filter;

        //     if (array_key_exists('name', $filters)) {
        //         $query->whereLike('name', $filters['name']);
        //     }
        // }

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
        $liqueur = Liqueur::create($request->all());

        return response()->json($liqueur, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liqueur  $liqueur
     * @return \Illuminate\Http\Response
     */
    public function show(Liqueur $liqueur)
    {
        return response()->json($liqueur, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Liqueur  $liqueur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liqueur $liqueur)
    {
        $liqueur->update($request->all());

        return response()->json($liqueur, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liqueur  $liqueur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liqueur $liqueur)
    {
        $liqueur->delete();

        return response()->json($liqueur, 201);
    }
}
