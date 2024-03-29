<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyValidateRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Company::latest();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('capital', $filters)) {
                $query->whereLike('capital', $filters['capital']);
            }
            if (array_key_exists('rif', $filters)) {
                $query->whereHas('taxpayer', function ($q) use ($filters) {
                    $q->whereLike('rif', $filters['active']);
                });
            }
            if (array_key_exists('active', $filters)) {
                $query->whereLike('active', $filters['active']);
            }
            if (array_key_exists('principal', $filters)) {
                $query->whereLike('principal', $filters['principal']);
            }
            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
            if (array_key_exists('phone', $filters)) {
                $query->whereLike('phone', $filters['phone']);
            }
            if (array_key_exists('email', $filters)) {
                $query->whereLike('email', $filters['email']);
            }
            if (array_key_exists('address', $filters)) {
                $query->whereLike('address', $filters['address']);
            }
            if (array_key_exists('constitution_date', $filters)) {
                $query->whereLike('constitution_date', $filters['constitution_date']);
            }
            if (array_key_exists('num_workers', $filters)) {
                $query->whereLike('num_workers', $filters['num_workers']);
            }
            if (array_key_exists('parish_id', $filters)) {
                $query->where('parish_id', '=', $filters['parish_id']);
            }
            if (array_key_exists('community_id', $filters)) {
                $query->where('community_id', '=', $filters['community_id']);
            }
            if (array_key_exists('taxpayer_id', $filters)) {
                $query->where('taxpayer_id', '=', $filters['taxpayer_id']);
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
    public function store(CompanyValidateRequest $request)
    {
        $company = Company::create($request->all());

        return response()->json($company, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $data = $company->load('taxpayer');

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyValidateRequest $request, Company $company)
    {
        $company->update($request->all());

        return response()->json($company, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json($company, 201);
    }
}
