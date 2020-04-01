<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Settlement;
use App\Payment;
use App\License;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $taxpayerCount = Taxpayer::count();
        $licenseCount = License::count();
        $paymentCount = Payment::whereStateId('2')
            ->count();
        $settlementCount = Settlement::whereStateId('2')
            ->count();

        return view('modules.dashboard.index')
            ->with('taxpayerCount', $taxpayerCount)
            ->with('paymentCount', $paymentCount)
            ->with('licenseCount', $licenseCount)
            ->with('settlementCount', $settlementCount);
    }
}
