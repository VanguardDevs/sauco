<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Taxpayer;
use DataTables;



class CreditController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Taxpayer $taxpayer)
    {
        if ($request->wantsJson()) {
            return $taxpayer->credits();
        }

        return view('modules.taxpayers.credits.index')
            ->with('taxpayer', $taxpayer);


    }


    /*public function list(Taxpayer $taxpayer, Credit $credit)
    {
        $query = $credit->taxpayer();

        return DataTables::of($query->get())->toJson();
    }*/


    /*public function list(Taxpayer $taxpayer)
    {
        $query = Credit::whereTaxpayerId($taxpayer->id)
            ->orderBy('credits.created_at', 'DESC');

        return DataTables::of($query)
            ->toJson();
    }*/


    public function list()
    {
        $query = Credit::query();

        return DataTables::eloquent($query)->toJson();
    }


}
