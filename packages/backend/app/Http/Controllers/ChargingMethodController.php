<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChargingMethod;
use App\Http\Requests\ChargingMethodCreateRequest;

class ChargingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ChargingMethod::latest()
            ->withCount('concepts');
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
    public function store(ChargingMethodCreateRequest $request)
    {
        $chargingMethod = ChargingMethod::create($request->all());

        return response()->json($chargingMethod, 201);

    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($method)
    {
        $method = ChargingMethod::find($method);

        return response()->json($method, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChargingMethodCreateRequest $request, $chargingMethod)
    {

        $chargingMethod = ChargingMethod::find($chargingMethod);

        $chargingMethod->update($request->all());

        return response()->json($chargingMethod, 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($method)
    {
        $method = ChargingMethod::find($method);

        $method->delete();

        return response()->json($method, 201);
    }
}
