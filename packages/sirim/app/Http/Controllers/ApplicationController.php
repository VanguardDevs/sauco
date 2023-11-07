<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\Taxpayer;
use App\Models\Payment;
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

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taxpayer $taxpayer)
    {
        return view('modules.taxpayers.applications.index')
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

    public function makePayment(Application $application)
    {
        $payment = $application->mountPayment();

        $liquidation = $application->makeLiquidation();
        $payment->liquidations()->sync($liquidation);

        return redirect()->route('liquidations.show', $liquidation->id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Taxpayer $taxpayer)
    {
        $concept = Concept::find($request->input('concept'));
        $amount = ($request->amount) ? $request->amount : $concept->calculateAmount();
        $representation = $taxpayer->representations()->first();

        if ($request->total) {
            $amount = $amount * $request->total;
        }

        //if ($concept->code == '001.005.000' && $representation == null || $concept->code == '001.005.001' && $representation == null){
        if ($concept->code == 'OTA.2023.056' && $representation == null || $concept->code == 'OTA.2023.058' && $representation == null){
            return redirect()->back()->withErrors(['concept' => '¡El contribuyente debe tener un representante para realizar esta solicitud!']);
        } else {
            $application = $taxpayer->applications()->create([
                'active' => 1,
                'concept_id' => $request->input('concept'),
                'user_id' => auth()->user()->id,
                'amount' => $amount,
                'num' => Application::getNewNum(),
                'total' => $request->total
            ]);

            return redirect()->route('applications.index', $taxpayer)
                ->withSuccess('¡Solicitud creada!');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Taxpayer $taxpayer, Application $application)
    {

        if (!$application->liquidation()->exists()) {
            return response()->json([
                'success' => false,
                'message' => '¡La solicitud tiene una liquidación asociada!'
            ]);
        }

        $application->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 1
        ]);

        $application->delete();

        return redirect()->back()
            ->withSuccess('¡Solicitud anulada!');
    }
}
