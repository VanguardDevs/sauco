<?php

namespace App\Http\Controllers;

use App\Models\AnnexedLiqueur;
use Illuminate\Http\Request;

class LiqueurAnnexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = AnnexedLiqueur::query();
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
        $annex = AnnexedLiqueur::create($request->all());

        return response()->json($annex, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnnexedLiqueur  $annex
     * @return \Illuminate\Http\Response
     */
    public function show(AnnexedLiqueur $annex)
    {
        return response()->json($annex, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnnexedLiqueur  $annex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnnexedLiqueur $annex)
    {
        $annex->update($request->all());

        return response()->json($annex, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnnexedLiqueur  $annex
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnexedLiqueur $annex)
    {
        $annex->delete();

        return response()->json($annex, 201);
    }
}
