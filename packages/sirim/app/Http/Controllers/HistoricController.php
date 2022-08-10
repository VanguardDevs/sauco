<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\Taxpayer;
use App\Models\Payment;
use App\Models\Liquidation;
use App\Models\CorrelativeNumber;
use App\Models\Correlative;
use App\Models\License;
use App\Models\Year;
use App\Models\Requirement;
use App\Models\RequirementTaxpayer;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AnnullmentRequest;
use Yajra\DataTables\Facades\DataTables;

class HistoricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.historic.index')
            ->with('taxpayer', $taxpayer)
            ->with('ordinances', Ordinance::pluck('description', 'id'));
    }

    public function list(Taxpayer $taxpayer)
    {
        $query = Application::whereTaxpayerId($taxpayer->id)
            ->orderBy('applications.created_at', 'DESC')
            ->with(['concept:id,name', 'liquidation']);

        return DataTables::eloquent($query)
            ->toJson();
    }

    public function listConcepts(Ordinance $ordinance)
    {
        return $ordinance->conceptsByList(1);
    }



    public function store(Request $request, Taxpayer $taxpayer)
    {

        $concept = Concept::find($request->input('concept'));
        $currYear = Year::where('year', Carbon::now()->year)->first();

        $liquidation = Liquidation::create([
            'num' => Liquidation::getNewNum(),
            'object_payment' => $concept->name.'  (Histórico / Período:'.$currYear->year . ')' ,
            'amount' => $request->input('amount'),
            'liquidable_type' => Liquidation::class,
            'concept_id' => $concept->id,
            'liquidation_type_id' => $concept->liquidation_type_id,
            'status_id' => 1,
            'taxpayer_id' => $taxpayer->id
        ]);

        $payment = Payment::create([
            'status_id' => 1,
            'user_id' => Auth::user()->id,
            'amount' => $request->input('amount'),
            'payment_method_id' => 1,
            'payment_type_id' => 1,
            'observations' => $request->input('observations'),
            'taxpayer_id' => $taxpayer->id
        ]);

        $payment->liquidations()->sync($liquidation);

        return redirect()->route('historics.index', $taxpayer)
                ->withSuccess('¡Liquidación creada!');
    }

    public function makePayment(Application $application)
    {
        $payment = $application->mountPayment();

        $liquidation = $application->makeLiquidation();
        $payment->liquidations()->sync($liquidation);

        return redirect()->route('liquidations.show', $liquidation->id);

    }


    public function listByTaxpayer(Taxpayer $taxpayer)
    {
        $query = $taxpayer->payments()
            ->with('status')
            ->orderBy('processed_at', 'DESC');

        return DataTables::of($query)
            ->addColumn('pretty_amount', function ($payment) {
                return $payment->pretty_amount;
            })
            ->make(true);
    }


}
