<?php

namespace App\Http\Controllers;

use App\Models\EconomicActivity;
use App\Models\Company;
use App\Models\Community;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.companies.index');
    }

    public function list()
    {
        $query = Company::query();

        return DataTables::eloquent($query)->toJson();
    }

    public function getRepresentations(Company $company)
    {
        $query = $company->representations()->with(['representationType', 'person']);

        return response()->json($query->get());
    }

    public function economicActivities(Company $company)
    {
        $query = $company->economicActivities;

        return $query;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Company $company)
    {
        if ($request->wantsJson()) {
            return $company;
        }

        return view('modules.companies.show')
            ->with('row', $company);
    }
}
