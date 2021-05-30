<?php

namespace App\Http\Controllers;

use App\Models\CommercialRegister;
use App\Http\Requests\CommercialRegisters\CommercialRegistersCreateFormRequest;
use App\Taxpayer;
use Illuminate\Http\Request;

class CommercialRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CommercialRegister::latest();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('num', $filters)) {
                $query->whereLike('num', $filters['num']);
            }
            if (array_key_exists('volume', $filters)) {
                $query->whereLike('volume', $filters['volume']);
            }
            if (array_key_exists('case_file', $filters)) {
                $query->whereLike('case_file', $filters['case_file']);
            }
            if (array_key_exists('start_date', $filters)) {
                $query->whereLike('start_date', $filters['start_date']);
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
    public function store(CommercialRegistersCreateFormRequest $request)
    {
        $commercialRegister = CommercialRegister::create($request->all());

        return $commercialRegister;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommercialRegister  $commercialRegister
     * @return \Illuminate\Http\Response
     */
    public function show(CommercialRegister $commercialRegister)
    {
        return $commercialRegister;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommercialRegister  $commercialRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommercialRegister $commercialRegister)
    {
        $commercialRegister->update($request->all());

        return $commercialRegister;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommercialRegister  $commercialRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommercialRegister $commercialRegister)
    {
        $commercialRegister->delete();

        return $commercialRegister;
    }
}
