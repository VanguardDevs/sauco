<?php

namespace App\Http\Controllers;

use App\Models\Taxpayer;
use App\Models\Liquidation;
use App\Models\CanceledLiquidation;
use App\Models\Concept;
use App\Models\Month;
use Illuminate\Http\Request;
use App\Http\Requests\AnnullmentRequest;
use Auth;

class LiquidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Taxpayer $taxpayer)
    {
        if ($request->wantsJson()) {
            $query = $taxpayer->liquidations()
                    ->with(['status', 'payment'])
                    ->orderBy('created_at', 'DESC')
                    ->orderBy('status_id', 'DESC');
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
    public function destroy(AnnullmentRequest $request, Liquidation $liquidation)
    {
        if ($liquidation->status_id == 1) {
            $liquidation->canceledLiquidation()->create([
                'reason' => $request->get('annullment_reason'),
                'user_id' => Auth::user()->id
            ]);
            $liquidation->liquidable()->delete();
            $liquidation->delete();

            return redirect()->back()
                ->withSuccess('¡Liquidación anulada!');
        }
    }
}
