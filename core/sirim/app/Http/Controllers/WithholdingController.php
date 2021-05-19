<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\Taxpayer;
use App\Models\Affidavit;
use App\Models\Month;
use App\Models\Payment;
use App\Models\Settlement;
use App\Models\Concept;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\AnnullmentRequest;
use Illuminate\Http\Request;
use DataTables;

class WithholdingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Taxpayer $taxpayer)
    {
        if ($request->wantsJson()) {
            return $taxpayer->deductions;
        }

        return view('modules.taxpayers.withholdings.index')
            ->with('taxpayer', $taxpayer);
    }

    public function months()
    {
        $months = Month::whereYearId(1);

        return $months->get();
    }

    public function list(Taxpayer $taxpayer)
    {
        $query = $taxpayer->deductions()
            ->with(['liquidation']);

        return DataTables::of($query->get())->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deduction  $withholding
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Deduction $withholding)
    {
        $liquidation = $withholding->liquidation;

        if ($liquidation->status_id == 2) {
            return redirect()->back()
                ->withErrors('¡La liquidación ya fue procesada!');
        }
        $affidavit = $liquidation->liquidable;
        $liquidation->update([
            'amount' => $affidavit->amount
        ]);

        if ($affidavit->fines()->exists()) {
            $concept = Concept::find(3);

            foreach($affidavit->fines as $fine) {
                $amount = $concept->calculateAmount($affidavit->amount);

                $fine->update([
                    'amount' => $amount
                ]);
                $fine->liquidation()->update([
                    'amount' => $amount
                ]);
            }
        }

        $liquidation->payment()->first()->updateAmount();

        $withholding->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 5
        ]);
        $withholding->delete();

        return redirect()->back()
            ->with('success', '¡Deducción anulada!');
    }
}
