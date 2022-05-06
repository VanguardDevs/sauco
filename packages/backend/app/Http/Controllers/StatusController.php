<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Status::query();
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
        $status = Status::create($request->all());

        return response()->json($status, 201);
    }

    public function show(Status $status)
    {
        return $status;
    }

    public function update(Request $request, Status $status)
    {
        $status->update($request->all());

        return response()->json($status, 201);
    }


    public function destroy(Status $status)
    {
        $status->delete();

        return response()->json($status, 201);
    }
}
