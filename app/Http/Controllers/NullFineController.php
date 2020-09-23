<?php

namespace App\Http\Controllers;

use App\NullFine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NullFineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = NullFine::latest('null_fines.created_at')
                ->with(['fine', 'user']);

            return DataTables::of($query->get())
                ->toJson();
        }
        return view('modules.reports.fines.cancelled-fines');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NullFine  $nullFine
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $nullFine) 
    {
        $nullFine = NullFine::find($nullFine); 

        if ($request->wantsJson()) {

           $data = $nullFine->load('fine', 'user'); 

           return response()->json($data);
        }

        return view('modules.reports.fines.show')
            ->with('row', $nullFine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NullFine  $nullFine
     * @return \Illuminate\Http\Response
     */
    public function edit(NullFine $nullFine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NullFine  $nullFine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NullFine $nullFine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NullFine  $nullFine
     * @return \Illuminate\Http\Response
     */
    public function destroy(NullFine $nullFine)
    {
        //
    }
}
