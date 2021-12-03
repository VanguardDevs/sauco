<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Signature::with('user')->latest();
        $results = $request->perPage;
        $filters = $request->has('filter') ? $request->filter : [];

        // Get fields
        if (array_key_exists('title', $filters)) {
            $query->whereLike($filters['title']);
        }
        if (array_key_exists('user', $filters)) {
            $query->whereHas('user', function ($query) use ($filters) {
                return $query->whereLike('login', $filters['user']);
            });
        }
        if (array_key_exists('status', $filters)) {
            $query->whereActive($filters['status']);
        }
        if (array_key_exists('decree', $filters)) {
            $query->whereLike($filters['decree']);
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
        $model = Signature::create($request->all());

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function show(Signature $signature)
    {
        return $signature;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signature $signature)
    {
        $signature->update($request->all());

        return $signature;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signature $signature)
    {
        $signature->update([
            'active' => !$signature->active
        ]);

        return $signature;
    }
}
