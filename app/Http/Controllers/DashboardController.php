<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Payment;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $taxpayerCount = Taxpayer::count();
        $settlementCount = Payment::count();

        return view('modules.dashboard.index')
            ->with('taxpayerCount', $taxpayerCount)
            ->with('settlementCount', $settlementCount);
    }
}
