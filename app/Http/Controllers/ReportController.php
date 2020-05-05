<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Payment;
use App\Taxpayer;
use App\EconomicActivity;
use App\License;
use Carbon\Carbon;
use PDF;
use Session;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display reports dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.reports.index');
    }

    /**
     * Display a listing of processed payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function payments()
    {
        return view('modules.reports.payments');
    }

    public function showUpToDateTaxpayers()
    {
        return view('modules.reports.up-to-date-taxpayers');
    }

    public function listUpToDate()
    {
        $taxpayers = $this->upToDateTaxpayers();

        return DataTables::eloquent($taxpayers)->toJson();
    }

    /**
     * Display a listing of null payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function showNullPayments()
    {
        return view('modules.reports.list-null-payments');
    }

    public function printPaymentReport(Request $request)
    {
        $firstDate = Carbon::parse($request->input('first_date'));
        $lastDate = Carbon::parse($request->input('last_date'));

        $payments = Payment::processedByDate($firstDate, $lastDate);

        // Prepare pdf
        $dateFormat = date('d-m-Y', strtotime($firstDate)).' - '.date('d-m-Y', strtotime($lastDate)); 
        $totalAmount = $payments->map(function ($row) {
            return $row->getOriginal('amount');
        })->sum();
        $total = number_format($totalAmount, 2, ',', '.')." Bs";

        $pdf = PDF::LoadView('modules.reports.pdf.payments', compact(['dateFormat', 'payments', 'total']));
        return $pdf->download('reporte-de-pagos.pdf');
    }

    public function printTaxpayersReport()
    {
        $taxpayers = Taxpayer::get();
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        $pdf = PDF::loadView('modules.reports.pdf.taxpayers', compact(['taxpayers', 'emissionDate']));
        return $pdf->download('contribuyentes-registrados-'.$emissionDate.'.pdf');
    }

    public function printActivityReport(EconomicActivity $activity)
    {
        $taxpayers = $activity->taxpayers;
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        if (!$taxpayers->count()) {
            return redirect()->back()
                ->withError('¡La actividad no tiene contribuyentes!');
        }

        $data = compact(['activity', 'emissionDate', 'taxpayers']);

        return PDF::setOptions(['isRemoteEnabled' => true])
            ->loadView('modules.reports.pdf.activity', $data)
            ->download('reporte-actividad-'.$activity->code.'.pdf');
    }

    public function printLicensesList()
    {
        $licenses = License::with(['taxpayer'])->get();
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        $data = compact(['licenses', 'emissionDate']);
        $pdf = PDF::loadView('modules.reports.pdf.licenses', $data);

        return $pdf->download('licencias-emitidas-'.$emissionDate.'.pdf');
    }

    public function upToDateTaxpayers()
    {
        $taxpayers = Taxpayer::whereHas('affidavits', function ($affidavit) {
            $affidavit->whereHas('payment', function ($payment) {
                $payment->where('state_id', '=', 2);
            })->where('month_id', '=', 3);
        });

        return $taxpayers;
    }

    public function printUpToDate()
    {
        $taxpayers = $this->upToDateTaxpayers()->get();
        $taxpayerCount = $taxpayers->count();
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));

        $pdf = PDF::loadView('modules.reports.pdf.taxpayers-uptodate', compact(['taxpayers', 'emissionDate', 'taxpayerCount']));
        return $pdf->download('contribuyentes'.$emissionDate.'.pdf');
    }        
}
