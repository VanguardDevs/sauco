<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Property::latest()
            ->with(['taxpayer']);
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('cadastre_num', $filters)) {
                $query->whereLike('cadastre_num', $filters['cadastre_num']);
            }
            if (array_key_exists('bulletin', $filters)) {
                $query->whereLike('bulletin', $filters['bulletin']);
            }
            if (array_key_exists('amount', $filters)) {
                $query->whereAmount($filters['amount']);
            }
            if (array_key_exists('parish_id', $filters)) {
                $id = $filters['parish_id'];

                $query->where('parish_id', '=', $id);
            }
            if (array_key_exists('community_id', $filters)) {
                $id = $filters['community_id'];

                $query->where('community_id', '=', $id);
            }
            if (array_key_exists('street_id', $filters)) {
                $id = $filters['street_id'];

                $query->where('street_id', '=', $id);
            }
            if (array_key_exists('taxpayer_id', $filters)) {
                $id = $filters['taxpayer_id'];

                $q->where('taxpayer_id', '=', $id);
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
        $property = Property::create($request->all());
        $taxpayer =  $request->get('taxpayer_id');
        $ownership = $request->get('ownership_status_id');
        $document = $request->get('document');

        $property->taxpayers()->sync([
            $taxpayer => [
                'document' => $document,
                'ownership_status_id' => $ownership
                'user_id' => $request->user()->id
            ]
        ]);

        return response()->json($property, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $data = $property->load([
            'taxpayers',
            'uses',
            'user',
            'parish',
            'community'
        ]);

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $property->update($request->all());

        return response()->json($property, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
