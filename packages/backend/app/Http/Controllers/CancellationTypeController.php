<?php

namespace App\Http\Controllers;

use App\Models\CancellationType;
use Illuminate\Http\Request;

class CancellationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CancellationType::withCount('cancellations');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CancellationType  $cancellationType
     * @return \Illuminate\Http\Response
     */
    public function show(CancellationType $cancellationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CancellationType  $cancellationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CancellationType $cancellationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CancellationType  $cancellationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CancellationType $cancellationType)
    {
        //
    }
}
