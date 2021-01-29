<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\Taxpayer;
use App\Models\Affidavit;
use App\Models\Month;
use App\Models\Payment;
use App\Models\Liquidation;
use App\Models\Concept;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\AnnullmentRequest;
use Illuminate\Http\Request;

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

        return view('modules.taxpayers.deductions.index')
            ->with('taxpayer', $taxpayer);
    }

    public function months()
    {
        $months = Month::whereYearId(1)
            ->where('id', '<', Carbon::now()->month);
        
        return $months->get();
    }

    public function list(Taxpayer $taxpayer)
    {
        $query = $taxpayer->deductions()
            ->with(['affidavit', 'payment']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Taxpayer $taxpayer)
    {
        $amount = $request->get('amount');
        $user = $request->get('user');
        $month = $request->get('month')['value']; 

        $affidavit = $taxpayer->affidavits()->whereMonthId($month)
            ->first();

        if (!$affidavit) {
            return response([
                'success' => false,
                'message' => '¡El mes no ha sido declarado!'
            ]);
        }

        $amount = $request->input('amount');
        $settlementAmount = $affidavit->amount - $amount;

        $settlement = $affidavit->settlement()->first();

        if (!$settlement) {
            return response()->json([
                'success' => false,
                'message' => '¡La declaración del mes de '.$affidavit->month->name.' no ha sido facturada!'
            ]);
        }
        if ($settlementAmount < 0) {
            return response()->json([
                'success' => false,
                'message' => '¡El monto a retener se excede del monto de la liquidación!. ('.$settlement->total_amount.').'
            ]);
        }
        if ($affidavit->deduction()->first()) {
            return response()->json([
                'success' => false,
                'message' => '¡Ya existe una retención realizada para la liquidación seleccionada!'
            ]);
        }
        if ($affidavit->payment()->first()->state_id == 2) {
            return response()->json([
                'success' => false,
                'message' => '¡El pago de ese mes se encuentra procesado!'
            ]);
        }
        
        // Save deduction
        $deduction = $affidavit->deduction()->create([
            'amount' => $amount,
            'affidavit_id' => $affidavit->id,
            'user_id' => $user
        ]);
 	
	    $settlement->update([
            'amount' => $settlementAmount,
            'deduction_id' => $deduction->id
        ]);
        $settlement->payment()->first()->updateAmount();

     
        return response()->json([
            'success' => true,
            'message' => '¡Retención de monto '.$deduction->amount.' realizada!'
        ]);
    }

    public function message(Affidavit $affidavit)
    {
        $concept = Concept::whereCode(8)->first();
        $conceptName = $concept->listing->name.': '.$concept->name.': ';
        $monthYear = ' ('.$affidavit->month->name.' - '.$affidavit->month->year->year.')';

        return $conceptName.$affidavit->taxpayer->name.$monthYear;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Deduction $deduction)
    {
        $payment = $deduction->payment()->first();

        if ($deduction->settlement) {
            $settlement = $deduction->settlement;
            $amount = $deduction->amount - $settlement->amount;
            $settlement->update(['amount' => $amount]);
            $payment->updateAmount();
        } 
        $deduction->delete();

        $deduction->nullDeduction()->create([
            'user_id' => Auth::user()->id,
            'reason' => $request->get('annullment_reason')
        ]);

        return redirect()->back()
            ->with('success', '¡Multa anulada!');   
    }
}
