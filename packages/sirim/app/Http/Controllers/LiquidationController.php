<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxpayer;
use App\Models\Concept;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MakeWithholdingRequest;
use App\Models\Liquidation;
use App\Http\Requests\AnnullmentRequest;
use Auth;
use App\Models\Withholding;

class LiquidationController extends Controller
{
    protected $typeForm = 'edit';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taxpayer $taxpayer, Request $request)
    {
        $query = $taxpayer->liquidations()->with('payment')->latest();

        if ($request->wantsJson()) {
            return DataTables::of($query)
                ->addColumn('pretty_amount', function ($query) {
                    return $query->pretty_amount;
                })->make(true);
        }

        return view('modules.taxpayers.liquidations.index')
            ->with('row', $taxpayer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidation $liquidation)
    {
        if ($liquidation->liquidation_type_id == 3
            && !($liquidation->deduction()->exists())
            && $liquidation->status_id == 1) {
            $this->typeForm = 'update';
        }

        return view('modules.taxpayers.liquidations.show')
            ->with('taxpayer', $liquidation->taxpayer)
            ->with('row', $liquidation)
            ->with('typeForm', $this->typeForm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MakeWithholdingRequest $request, Liquidation $liquidation)
    {
        // Substract amount
        $amount = $request->input('withholding_amount');
        $newLiquidationAmount = $liquidation->amount - $amount;

        if ($amount == 0 || $newLiquidationAmount == 0 || $newLiquidationAmount < 0) {
            return redirect()->back()
                ->withErrors([
                    'withholding_amount' => 'El monto especificado excede el total de la liquidación.'
                ]);
        }

        // Save withholding
        $deduction = $liquidation->deduction()->create([
            'amount' => $amount,
            'user_id' => Auth::user()->id
        ]);

	    $liquidation->update([
            'amount' => $newLiquidationAmount,
        ]);

        $affidavit = $liquidation->liquidable()->first();

        // Adjust fines
        if ($affidavit->fines()->exists()) {
            $concept = Concept::find(3);

            foreach($affidavit->fines as $fine) {
                $amount = $concept->calculateAmount($newLiquidationAmount);

                $fine->update([
                    'amount' => $amount
                ]);
                $fine->liquidation()->update([
                    'amount' => $amount
                ]);
            }
        }

        $liquidation->payment->first()->updateAmount();

        $withholding = Withholding::create([
            'num' => Withholding::getNewNum(),
            'amount' => $amount,
            'taxpayer_id' => 1085,
            'retainer_id' =>  $liquidation->taxpayer_id
        ]);

        $withholding->mountPayment();

        $liquidation = $withholding->makeLiquidation();

        return redirect()->back()
            ->withSuccess('¡Retención de '.$deduction->amount.' aplicada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Liquidation $liquidation)
    {
        $liquidation->delete();

        $liquidation->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 6
        ]);

        // Update payment amount
        if ($liquidation->payment()->exists()) {
            $liquidation->payment()->first()->updateAmount();
        }

        if ($liquidation->movement()->exists()) {
            $liquidation->movement()->delete();
        }

        return redirect()->back()
            ->withSuccess('¡Liquidación anulada!');
    }
}
