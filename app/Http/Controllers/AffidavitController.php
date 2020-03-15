<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Month;
use App\Settlement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AffidavitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Taxpayer $taxpayer)
    {
        $months = Month::where('id', '<', Carbon::now()->month);

        return view('modules.declarations.index')
            ->with('months', $months->pluck('name', 'id'))
            ->with('taxpayer', $taxpayer);
    }

    public function listAffidavits(Taxpayer $taxpayer)
    {
        $query = $taxpayer->declarations();

        return DataTables::eloquent($query)->toJson();
    }

    public function show(Settlement $settlement)
    {
        if ($settlement->state->id == 1) {
            if (!Auth::user()->can('process.settlements'))  {
                return redirect('cashbox/settlements')
                    ->withError('¡No puede procesar la liquidación!');
            }

            return view('modules.cashbox.select-settlement')
                ->with('row', $settlement);
        }
        // The settlement it's already processed    
        return view('modules.cashbox.register-settlement')
            ->with('typeForm', 'show')
            ->with('row', $settlement);
    }

    public function download(Settlement $settlement)
    {
        dd($settlement);
    }
}
