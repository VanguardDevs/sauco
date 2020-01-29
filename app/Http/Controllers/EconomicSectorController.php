<?php

namespace App\Http\Controllers;

use App\EconomicSector;
use App\Http\Requests\EconomicSectors\EconomicSectorsCreateFormRequest;
use App\Http\Requests\EconomicSectors\EconomicSectorsUpdateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EconomicSectorController extends Controller
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
        return view('modules.economic-sectors.index');
    }

    public function list()
    {
        $query = EconomicSector::query();

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.economic-sectors.register')
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EconomicSectorsCreateFormRequest $request)
    {
        $create = new EconomicSector([
            'description' => $request->input('description')
        ]);
        $create->save();

        return redirect('settings/economic-sectors')
            ->withSuccess('¡Sector económico registrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EconomicSector  $economicSector
     * @return \Illuminate\Http\Response
     */
    public function show(EconomicSector $economicSector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EconomicSector  $economicSector
     * @return \Illuminate\Http\Response
     */
    public function edit(EconomicSector $economicSector)
    {
        return view('modules.economic-sectors.register')
            ->with('row', $economicSector)
            ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EconomicSector  $economicSector
     * @return \Illuminate\Http\Response
     */
    public function update(EconomicSectorsUpdateFormRequest $request, EconomicSector $economicSector)
    {
        $row = EconomicSector::find($economicSector->id)->first();
        $row->description = $request->description;
        $row->save();

        return redirect('settings/economic-sectors')
            ->withSuccess('¡Sector económico actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EconomicSector  $economicSector
     * @return \Illuminate\Http\Response
     */
    public function destroy(EconomicSector $economicSector)
    {
        //
    }
}
