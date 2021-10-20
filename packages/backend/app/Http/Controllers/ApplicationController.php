<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Ordinance;
use App\Models\Concept;
use App\Models\Taxpayer;
use App\Models\Payment;
use App\Models\Liquidation;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Application::orderBy('num', 'ASC')
            ->with('concept', 'taxpayer');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('num', $filters)) {
                $query->whereLike('num', $filters['num']);
            }
            if (array_key_exists('taxpayer', $filters)) {
                $query->whereHas('taxpayer', function ($q) use ($filters) {
                    $query->whereLike('taxpayer', $filters['taxpayer']);
                });
            }
            if (array_key_exists('amount', $filters)) {
                $query->whereLike('amount', $filters['amount']);
            }
            if (array_key_exists('concept_id', $filters)) {
                $query->where('concept_id', '=', $filters['concept_id']);
            }
            if (array_key_exists('taxpayer_id', $filters)) {
                $query->where('taxpayer_id', '=', $filters['taxpayer_id']);
            }
            if (array_key_exists('gt_date', $filters)) {
                $query->whereDate('created_at', '>=', $filters['gt_date']);
            }
            if (array_key_exists('lt_date', $filters)) {
                $query->whereDate('created_at', '<', $filters['lt_date']);
            }
        }

        return $query->paginate($results);
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

        $application->makeLiquidation();

        return redirect()
            ->route('liquidations.index', $application->taxpayer_id)
            ->withSuccess('¡Liquidación realizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Application $application)
    {
        if (!$application->liquidation()->exists()) {
            return response()
                ->json('¡La solicitud tiene una liquidación asociada!', 400);
        }

        $application->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 1
        ]);

        $application->delete();

        return response()
            ->json('¡Solicitud '.$application->num.' anulada!', 200);
    }
}
