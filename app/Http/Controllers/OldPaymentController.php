<?php

namespace App\Http\Controllers;

use App\OldPayment;
use App\Taxpayer;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OldPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Taxpayer $taxpayer)
    {
        if ($request->ajax()) {
            return $taxpayer->oldPayments->get();
        }

        return view('modules.taxpayers.old-payments.index')
            ->with('taxpayer', $taxpayer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Concept::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recapiURL = config('app.recapi').'/payments';
        $client = new Client();
        
        $data = [
            'num' => $request->get('num')
        ];

        $res = $client->request('POST', $recapiURL, [
            'json' => $data
        ]);
        $content = json_decode($res->getBody()->getContents());

        return response()->json($content); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldPayment  $oldPayment
     * @return \Illuminate\Http\Response
     */
    public function show(OldPayment $oldPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldPayment  $oldPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(OldPayment $oldPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldPayment  $oldPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldPayment $oldPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldPayment  $oldPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldPayment $oldPayment)
    {
        //
    }
}
