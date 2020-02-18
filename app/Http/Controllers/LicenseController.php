<?php

namespace App\Http\Controllers;

use App\License;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use PDF;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('modules.licenses.index');
    }

    public function list()
    {
        $query = License::query()
		    ->with('taxpayer');

    	return DataTables::eloquent($query)->toJson();
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
    public function store(Request $request, License $license)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        return view('modules.licenses.show')
            ->with('row', $license);
    }

    public function download(License $license)
    {
        $taxpayer = $license->taxpayer;
        $endOfYear = date('d-m-Y', strtotime(Carbon::now()->copy()->endOfYear()));
        $licenseNum = preg_replace('~\D~', '', $taxpayer->rif);
        $correlative = $license->correlative;
        $licenseCorrelative = $correlative->correlativeType->description.
                            $correlative->fiscalYear->year.'-'
                            .$correlative->correlativeNumber->num;

        $pdf = PDF::LoadView('modules.licenses.pdf.economic-activity-license', compact(['endOfYear', 'licenseNum', 'license', 'licenseCorrelative']));
        return $pdf->stream('Licencia '.$taxpayer->rif.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function edit(License $License)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $License)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\License  $License
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $License)
    {
        //
    }
}
