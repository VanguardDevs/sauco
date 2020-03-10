<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('modules.reports.index');
    }

    public function payments()
    {
        return view('modules.reports.payments');
    }

    public function printPaymentReport(Request $request)
    {
        $payments = Payment::processedByDate();
        $total = number_format($payments->sum('amount'), 2, ',', '.')." Bs";

        $pdf = PDF::LoadView('modules.reports.pdf.payment', compact(['payments', 'total']));
        return $pdf->stream('reporte-de-pagos.pdf');
    }
}
