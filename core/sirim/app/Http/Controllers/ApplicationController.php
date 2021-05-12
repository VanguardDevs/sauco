<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\Taxpayer;
use App\Models\Payment;
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
            ->with(['concept:id,name']);

        return DataTables::eloquent($query)
            ->toJson();
    }

    public function listConcepts(Ordinance $ordinance)
    {
        return $ordinance->conceptsByList(1);
    }

    public function makePayment(Application $application)
    {
        $payment = $application->payment();

        if ($payment) {
            return redirect()->route('payments.show', $payment->first());
        }

        $payment = $application->mountPayment();

        $liquidation = $application->makeLiquidation();

        $payment->liquidations()->sync($liquidation);

        return redirect()->route('payments.show', $payment->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Taxpayer $taxpayer)
    {
        $concept = Concept::find($request->input('concepts'));
        $amount = $concept->calculateAmount();

        $application = $taxpayer->applications()->create([
            'active' => 1,
            'concept_id' => $request->input('concepts'),
            'user_id' => auth()->user()->id,
            'amount' => $amount
        ]);

        return redirect()->route('applications.index', $taxpayer)
            ->withSuccess('¡Solicitud creada!');
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
    public function destroy(AnnullmentRequest $request, Application $application)
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
            ->with('success', '¡Solicitud anulada!');
    }
}
