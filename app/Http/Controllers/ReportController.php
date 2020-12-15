<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Payment;
use App\Affidavit;
use App\Taxpayer;
use App\EconomicActivity;
use App\License;
use Carbon\Carbon;
use PDF;
use Session;

class ReportController extends Controller
{
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
        return view('modules.reports.payments.payments');
    }

    public function delinquentCompanies(Request $request)
    {
        $query = Taxpayer::whereHas('affidavits', function ($query) {
            $query->whereDoesntHave('payment')
                ->orWhereHas('payment', function ($query) {
                    $query->where('state_id', '=', 1);
                });
        });

        if ($request->wantsJson()) {
            return DataTables::eloquent($query)->toJson();
        }

        return view('modules.reports.delinquent-companies.index')
            ->with('totalCompanies', $query->count());
    }

    public function printPaymentReport(Request $request)
    {
        $firstDate = Carbon::parse($request->input('first_date'));
        $lastDate = Carbon::parse($request->input('last_date'));

        $payments = Payment::processedByDate($firstDate, $lastDate);

        // Prepare pdf
        $dateFormat = date('d-m-Y', strtotime($firstDate)).' - '.date('d-m-Y', strtotime($lastDate)); 
        $totalAmount = $payments->sum('amount');
        $total = number_format($totalAmount, 2, ',', '.')." Bs";

        $pdf = PDF::LoadView('modules.reports.pdf.payments', compact(['dateFormat', 'payments', 'total']));
        return $pdf->download('reporte-de-pagos.pdf');
    }

    public function printAffidavitsReport(Request $request)
    {
        $firstDate = Carbon::parse($request->input('first_date'));
        $lastDate = Carbon::parse($request->input('last_date'));

        $payments = Affidavit::processedByDate($firstDate, $lastDate);

        // Prepare pdf
        $dateFormat = date('d-m-Y', strtotime($firstDate)).' - '.date('d-m-Y', strtotime($lastDate)); 
        $totalAmount = $payments->sum('amount');
        $total = number_format($totalAmount, 2, ',', '.')." Bs";

        $pdf = PDF::LoadView('modules.reports.pdf.payments', compact(['dateFormat', 'payments', 'total']));
        return $pdf->download('reporte-de-pagos.pdf');
    }

    public function printTaxpayersReport()
    {
        $taxpayers = Taxpayer::orderBy('created_at', 'ASC')->get();
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));
        $total = Taxpayer::count();

        $pdf = PDF::loadView('modules.reports.pdf.taxpayers', compact(['taxpayers', 'emissionDate', 'total']))
            ->setPaper('a4', 'letter');
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

    public function printActivitiesReport()
    {
        $emissionDate = date('d-m-Y', strtotime(Carbon::now()));
        $activities = EconomicActivity::get();
        $total = EconomicActivity::count();

        $pdf = PDF::loadView('modules.reports.pdf.activities', compact(['activities', 'total', 'emissionDate' ]))->setPaper('a4', 'letter');
        return $pdf->download('actividades-economicas.pdf');
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
