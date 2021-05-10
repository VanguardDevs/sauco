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

class DeductionController extends Controller
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
        $payment = $withholding->payment()->first();

        if ($withholding->settlement) {
            $settlement = $withholding->settlement;
            $amount = $settlement->amount - $withholding->amount;
            $settlement->update(['amount' => $amount]);
            $payment->updateAmount();
        }
        $withholding->delete();

        $withholding->cancellations()->create([
            'reason' => $request->get('annullment_reason'),
            'user_id' => Auth::user()->id,
            'cancellation_type_id' => 5
        ]);

        return redirect()->back()
            ->with('success', '¡Retención anulada!');
    }
}
