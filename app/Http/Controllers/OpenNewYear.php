<?php

namespace App\Http\Controllers;

use App\Year;
use App\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OpenNewYear extends Controller
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
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $currYear = Carbon::now()->year;
        $year = Year::where('year', $currYear)->first();
        
        if (!$year) {
            $year = Year::create([
                'year' => $currYear
            ]);

            foreach ($this->months as $key => $value) {
                Month::create([
                    'name' => $value,
                    'year_id' => $year->id
                ]);
            }
            
            return response()->json([
                'ok' => true,
                'message' => '¡Año '.$year->year.' abierto!'
            ], 200);
        } 
            
        return response()->json([
            'ok' => false,
            'message' => '¡No puede abrir otro año!'
        ], 400);
    }
}
