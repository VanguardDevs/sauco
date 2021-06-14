<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Ordinance;
use App\Models\ChargingMethod;
use App\Models\LiquidationType;
use App\Models\AccountingAccount;
use App\Http\Requests\ConceptsValidateRequest;
use Illuminate\Http\Request;

class ConceptController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:super-admin')
            ->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Concept::latest()
            ->with(['liquidationType']);
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
            if (array_key_exists('charging_method_id', $filters)) {
                $query->where('charging_method_id', '=', $filters['charging_method_id']);
            }
            if (array_key_exists('ordinance_id', $filters)) {
                $query->where('ordinance_id', '=', $filters['ordinance_id']);
            }
            if (array_key_exists('accounting_account_id', $filters)) {
                $query->where('accounting_account_id', '=', $filters['accounting_account_id']);
            }
            if (array_key_exists('interval_id', $filters)) {
                $query->where('interval_id', '=', $filters['interval_id']);
            }
            if (array_key_exists('liquidation_type_id', $filters)) {
                $query->where('liquidation_type_id', '=', $filters['liquidation_type_id']);
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
    public function store(ConceptsValidateRequest $request)
    {
        $concept = Concept::create(array_merge(
            ['code' => Concept::getNewCode()],
            $request->input()
        ));

        return $concept;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function show(Concept $Concept)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function update(ConceptsValidateRequest $request, Concept $concept)
    {
        $concept->update($request->input());

        return $concept;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concept $concept)
    {
        $concept->delete();

        return $concept;
    }
}
