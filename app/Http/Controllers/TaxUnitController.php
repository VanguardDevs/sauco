<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxUnits\TaxUnitsCreateFormRequest;
use App\Models\TaxUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaxUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = TaxUnit::query();

            return DataTables::eloquent($query)->toJson();
        }
        return view('modules.tax-units.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.tax-units.register')
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxUnitsCreateFormRequest $request)
    {
        $create = TaxUnit::create([
            'law' => $request->input('law'),
            'value' => $request->input('value'),
            'publication_date' => $request->input('publication_date')
        ]);
        $create->save();

        return redirect('settings/tax-units')->withSuccess('¡Unidad Tributaria actualizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaxUnit  $taxUnit
     * @return \Illuminate\Http\Response
     */
    public function show(TaxUnit $taxUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaxUnit  $taxUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxUnit $taxUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxUnit  $taxUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxUnit $taxUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxUnit  $taxUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxUnit $taxUnit)
    {
        //
    }
}
