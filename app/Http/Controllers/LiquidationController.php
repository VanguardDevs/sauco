<?php

namespace App\Http\Controllers;

use App\Taxpayer;
use App\Liquidation;
use App\CanceledLiquidation;
use App\Concept;
use App\Month;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AnnullmentRequest;
use Auth;

class LiquidationController extends Controller
{    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Taxpayer $taxpayer)
    {
        if ($request->wantsJson()) {
            $query = $taxpayer->liquidations()
                    ->with(['status', 'liquidationType', 'payment'])
                    ->orderBy('created_at', 'DESC')
                    ->orderBy('status_id', 'DESC');

            return DataTables::eloquent($query)->toJson();
        }
        return view('modules.taxpayers.liquidations.index')
            ->with('taxpayer', $taxpayer);
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Liquidation  $liquidation
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidation $liquidation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidation  $liquidation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidation $liquidation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liquidation  $liquidation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Liquidation $liquidation)
    {
        if ($liquidation->status_id == 1) {
            $liquidation->canceledLiquidation()->create([
                'reason' => $request->get('annullment_reason'),
            ]);

            $type = $liquidation->liquidation_type_id;

            switch ($type) {
                case 1:
                    $liquidation->application()->delete();        
                    break;
                case 2:
                    $liquidation->fine()->delete();
                    break;
                case 3:
                    $affidavit = $liquidation->affidavit;
                    if ($affidavit->withholding()->exists()) {
                        $affidavit->withholding()->delete();
                    }
                    $affidavit->delete();
                    break;
            }
            $liquidation->delete();

            return redirect()->back()
                ->withSuccess('¡Liquidación anulada!');
        }
    }
}
