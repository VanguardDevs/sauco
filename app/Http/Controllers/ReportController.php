<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Carbon\Carbon;
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
        $date = Carbon::parse($request->input('date'));
        $payments = Payment::processedByDate($date);
        $dateFormat = date('d-m-Y', strtotime($date)); 
        $total = number_format($payments->sum('amount'), 2, ',', '.')." Bs";

        $pdf = PDF::LoadView('modules.reports.pdf.payments', compact(['dateFormat', 'payments', 'total']));
        return $pdf->stream('reporte-de-pagos.pdf');
    }
}
