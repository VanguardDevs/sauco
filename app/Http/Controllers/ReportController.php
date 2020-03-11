<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Taxpayer;
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
        return $pdf->download('reporte-de-pagos.pdf');
    }

    public function printTaxpayersReport()
    {
        $taxpayers = Taxpayer::get();
        $emissionDate = Carbon::now()->toDateString();
        
        $pdf = PDF::loadView('modules.reports.pdf.taxpayers', compact(['taxpayers', 'emissionDate']));
        return $pdf->stream('contribuyentes-registrados.pdf');
    }
}
