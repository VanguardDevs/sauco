<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;

class YearController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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


    // public function index()
    // {
    //     return view('modules.settings.years.index')
    //         ->with('years', Year::get());
    // }

    public function index(Request $request)
    {
        $query = Year::query();
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('year', $filters)) {
                $query->whereLike('year', $filters['year']);
            }
        }

        return $query->paginate($results);
    }

    public function listMonths(Year $year)
    {
        if ($year->year == Carbon::now()->year) {
            return $year->months()
                ->where('id', '<', Carbon::now()->month)
                ->get();
        }

        return $year->months()->orderBy('id', 'ASC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        return view('modules.settings.years.register');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestYear = $request->input('year');
        $year = Year::where('year', $requestYear)->first();

        if (!$year) {
            $year = Year::create([
                'year' => $requestYear
            ]);

            foreach ($this->months as $key => $value) {
                Month::create([
                    'name' => $value,
                    'year_id' => $year->id
                ]);
            }

            return response()->json($year, 201);

            return redirect('settings/years')
               ->withSuccess('¡Año fiscal '.$year->year.' abierto!');


        }

        return redirect()->back()
            ->withError('¡El año '.$requestYear. ' se encuentra abierto!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        return response()->json($year, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        $year->update($request->all());

        return response()->json($year, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        $year->delete();

        return response()->json($year, 201);
    }
}
