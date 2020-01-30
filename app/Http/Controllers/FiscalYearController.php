<?php

namespace App\Http\Controllers;

use App\FiscalYear;
use App\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FiscalYearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $months = Array(
        'ENERO', 'FEBRERO', 'MARZO', 'ABRIL',
        'MAYO', 'JUNIO', 'JULIO', 'AGOSTO',
        'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currYear = Carbon::now()->year;
        $year = FiscalYear::where('year', $currYear)->first();

        if (!$year) {
            $fiscalYear = FiscalYear::create([
                'year' => $currYear
            ]);

            foreach ($this->months as $key => $value) {
                Month::create([
                    'name' => $value,
                    'fiscal_year_id' => $fiscalYear->id
                ]);
            }

            return redirect('settings/general')
                ->withSuccess('¡Año fiscal abierto!');
        }
        return redirect('settings/general')
            ->withErrors('¡No puede abrir otro año fiscal!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FiscalYear  $fiscalYear
     * @return \Illuminate\Http\Response
     */
    public function show(FiscalYear $fiscalYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FiscalYear  $fiscalYear
     * @return \Illuminate\Http\Response
     */
    public function edit(FiscalYear $fiscalYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FiscalYear  $fiscalYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FiscalYear $fiscalYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FiscalYear  $fiscalYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(FiscalYear $fiscalYear)
    {
        //
    }
}
