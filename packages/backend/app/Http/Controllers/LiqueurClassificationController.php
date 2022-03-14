<?php

namespace App\Http\Controllers;

use App\Models\LiqueurClassification;
use Illuminate\Http\Request;

class LiqueurClassificationController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = LiqueurClassification::query();
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
    public function show(LiqueurClassification $LiqueurClassification)
    {
        return $LiqueurClassification;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $liqueurclassification = LiqueurClassification::create($request->all());

        return $liqueurclassification;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiqueurClassification  $LiqueurClassification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiqueurClassification $LiqueurClassification)
    {
        $LiqueurClassification->update($request->all());

        return $LiqueurClassification;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return $item;
    }
}
