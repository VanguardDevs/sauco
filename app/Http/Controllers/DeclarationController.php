<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeclarationController extends Controller
{
    public function index(Taxpayer $taxpayer)
    {
        return view('modules.declarations.index')
            ->with('taxpayer', $taxpayer);
    }

    public function listDeclarations(Taxpayer $taxpayer)
    {
        $query = $taxpayer->declarations();

        return DataTables::eloquent($query)->toJson();
    }
}
