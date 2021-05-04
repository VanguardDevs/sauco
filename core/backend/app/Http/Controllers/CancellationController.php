<?php

namespace App\Http\Controllers;

use App\Models\Cancellation;
use Illuminate\Http\Request;

class CancellationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Cancellation::with(['type', 'user'])
            ->orderBy('created_at', 'DESC');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('cancellation_type_id', $filters)) {
                $query->where('cancellation_type_id', '=', $filters['cancellation_type_id']);
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
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function show(Cancellation $cancellation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancellation $cancellation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cancellation $cancellation)
    {
        //
    }
}
