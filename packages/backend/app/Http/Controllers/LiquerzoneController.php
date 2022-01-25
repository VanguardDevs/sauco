<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiquerzoneController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Liquerzone::query();
        $results = $Liquerzone->perPage;

        if ($Liquerzone->has('filter')) {
            $filters = $Liquerzone->filter;

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
        $model = Liquerzone::create($Liquerzone->all());

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LiquerzoneModel  $LiquerzoneModel
     * @return \Illuminate\Http\Response
     */
    public function show(LiquerzoneModel $LiquerzoneModel)
    {
        return $Liquerzone;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LiquerzoneModel  $LiquerzoneModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiquerzoneModel $LiquerzoneModel)
    {
        $Liquerzone->update($Liquerzone->all());

        return $Liquerzone;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LiquerzoneModel  $LiquerzoneModel
     * @return \Illuminate\Http\Response
     */
    public function destroy (LiquerzoneModel $LiquerzoneModel)
    {
        $Liquerzone->delete();

        return $Liquer;
    }
}
