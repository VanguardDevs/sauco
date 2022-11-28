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
use Carbon\Carbon;
use PDF;
use App\Models\Withholding;
use App\Models\Credit;

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
        $realAmount = $liquidation->amount - $amount;

        // Save withholding
        $deduction = $liquidation->deduction()->create([
            'amount' => $amount,
            'user_id' => Auth::user()->id,
            'payment_id' => $liquidation->payment->first()->id
        ]);

        if ($realAmount >= 0) {
            $liquidation->update([
                'amount' => $realAmount,
            ]);
        } else {
            $liquidation->credit()->create([
                'num' => Credit::getNewNum(),
                'amount' => $realAmount * -1,
                'taxpayer_id' => $liquidation->taxpayer_id,
                'payment_id' => $liquidation->payment->first()->id
            ]);
        }

        $liquidation->payment->first()->updateAmount();

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

        if ($liquidation->credit()->exists()) {
            $liquidation->credit()->delete();
        }

        if ($liquidation->requirementTaxpayer()->exists()) {
            $liquidation->requirementTaxpayer()->delete();
        }

        return redirect()->back()
            ->withSuccess('¡Liquidación anulada!');
    }

    public function download(Liquidation $liquidation)
    {
        if ($liquidation->status->id == 1) {
            return redirect()->back()
                ->withError('¡La liquidación no ha sido procesada!');
        }

            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('pdf.liquidation', compact('liquidation'))
                ->stream('liquidacion-'.$liquidation->id.'.pdf');
   }



    public function ticket(Liquidation $liquidation)
    {
        if ($liquidation->status->id == 1) {
            return redirect()->back()
                ->withError('¡La liquidación no ha sido procesada!');
        }

        $customPaper = array(0,0,228,230);
            return PDF::setOptions(['isRemoteEnabled' => true])
                ->loadView('pdf.liquidation-ticket', compact('liquidation'))
                ->setPaper($customPaper)
                ->stream('liquidacion-ticket-'.$liquidation->id.'.pdf');

   }
}
