<?php

namespace App\Http\Controllers;

use App\Models\LiqueurParametre;
use Illuminate\Http\Request;

class LiqueurParametreController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = LiqueurParametre::query();
        $results = $request->perPage;
        $sort = $request->sort;
        $order = $request->order;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
        }

        if ($sort && $order) {
            $query->orderBy($sort, $order);
        }

        return $query->paginate($results);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LiqueurParametre $LiqueurParametre)
    {
        return $LiqueurParametre;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $LiqueurParametre = LiqueurParametre::create($request->all());

        return $LiqueurParametre;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiqueurParametre  $LiqueurParametre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiqueurParametre $LiqueurParametre)
    {
        $LiqueurParametre->update($request->all());

        return $LiqueurParametre;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiqueurParametre  $LiqueurParametre
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiqueurParametre $LiqueurParametre)
    {
        $LiqueurParametre->delete();

        return $LiqueurParametre;
    }
}
