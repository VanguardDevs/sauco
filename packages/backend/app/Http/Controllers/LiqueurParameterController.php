<?php

namespace App\Http\Controllers;

use App\Models\LiqueurParameter;
use Illuminate\Http\Request;

class LiqueurParameterController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = LiqueurParameter::query();
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
    public function show(LiqueurParameter $LiqueurParameter)
    {
        return $LiqueurParameter;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $LiqueurParameter = LiqueurParameter::create($request->all());

        return $LiqueurParameter;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiqueurParameter  $LiqueurParameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiqueurParameter $LiqueurParameter)
    {
        $LiqueurParameter->update($request->all());

        return $LiqueurParameter;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiqueurParameter  $LiqueurParameter
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiqueurParameter $LiqueurParameter)
    {
        $LiqueurParameter->delete();

        return $LiqueurParameter;
    }
}
