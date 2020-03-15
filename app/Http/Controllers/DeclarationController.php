<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Month;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class DeclarationController extends Controller
{
    public function index(Taxpayer $taxpayer)
    {
        $months = Month::where('id', '<', Carbon::now()->month);

        return view('modules.declarations.index')
            ->with('months', $months->pluck('name', 'id'))
            ->with('taxpayer', $taxpayer);
    }

    public function listDeclarations(Taxpayer $taxpayer)
    {
        $query = $taxpayer->declarations();

        return DataTables::eloquent($query)->toJson();
    }
}
