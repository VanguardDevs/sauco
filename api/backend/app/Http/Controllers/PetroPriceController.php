<?php

namespace App\Http\Controllers;

use App\Models\PetroPrice;
use Illuminate\Http\Request;

class PetroPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PetroPrice::query();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('value', $filters)) {
                $query->whereLike('value', $filters['value']);
            }
            if (array_key_exists('gt_date', $filters)) {
                $query->whereDate('created_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('created_at', '<', $filters['lt_date']);
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
     * @param  \App\Models\PetroPrice  $petroPrice
     * @return \Illuminate\Http\Response
     */
    public function show(PetroPrice $petroPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetroPrice  $petroPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PetroPrice $petroPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetroPrice  $petroPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetroPrice $petroPrice)
    {
        //
    }
}
