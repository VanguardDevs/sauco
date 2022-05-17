<?php

namespace App\Http\Controllers;

use App\Models\Interval;
use Illuminate\Http\Request;

class IntervalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Interval::latest();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
        }

        return $query->paginate($results);
    }


    public function store(Request $request)
    {
        $interval = Interval::create($request->all());

        return response()->json($interval, 201);
    }


    public function show(Interval $interval)
    {
        return $interval;
    }


    public function update(Request $request, Interval $interval)
    {
        $interval->update($request->all());

        return response()->json($interval, 201);
    }


    public function destroy(Interval $interval)
    {
        $interval->delete();

        return response()->json($interval, 201);
    }
}
