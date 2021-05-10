<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Ordinance;
use App\Models\ChargingMethod;
use App\Models\LiquidationType;
use App\Models\AccountingAccount;
use App\Http\Requests\Concepts\ConceptsCreateFormRequest;
use Illuminate\Http\Request;

class ConceptController extends Controller
{
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
        }

        return $query->paginate($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConceptsCreateFormRequest $request)
    {
        $concept = Concept::create(array_merge(
            ['code' => Concept::getNewCode()],
            $request->input()
        ));

        return redirect('settings/concepts')
            ->withSuccess('¡Concepto de recaudación creado!');
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
    public function update(Request $request, Concept $concept)
    {
        $concept->update($request->input());

        return redirect('settings/concepts')
            ->withSuccess('¡Concepto de recaudación actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concept  $Concept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concept $Concept)
    {
        //
    }
}
