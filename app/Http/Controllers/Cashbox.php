<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cashbox extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        dd("USTED ESTA EN LA CAJA");
        return view('modules.cashbox.index');
    }
}
