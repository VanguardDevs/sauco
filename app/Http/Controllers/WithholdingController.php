<?php

namespace App\Http\Controllers;

use App\Withholding;
use App\Taxpayer;
use App\Affidavit;
use App\Month;
use App\Payment;
use App\Liquidation;
use App\Concept;
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
            return $taxpayer->withholdings;
        }

        return view('modules.taxpayers.withholdings.index')
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
        $query = $taxpayer->withholdings()
            ->with(['affidavit', 'payment']);

        return DataTables::of($query->get())->toJson();
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
        if ($affidavit->withholding()->first()) {
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
        
        // Save withholding
        $withholding = $affidavit->withholding()->create([
            'amount' => $amount,
            'affidavit_id' => $affidavit->id,
            'user_id' => $user
        ]);
 	
	    $settlement->update([
            'amount' => $settlementAmount,
            'withholding_id' => $withholding->id
        ]);
        $settlement->payment()->first()->updateAmount();

     
        return response()->json([
            'success' => true,
            'message' => '¡Retención de monto '.$withholding->amount.' realizada!'
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
     * @param  \App\Withholding  $withholding
     * @return \Illuminate\Http\Response
     */
    public function show(Withholding $withholding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Withholding  $withholding
     * @return \Illuminate\Http\Response
     */
    public function edit(Withholding $withholding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Withholding  $withholding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withholding $withholding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Withholding  $withholding
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnullmentRequest $request, Withholding $withholding)
    {
        $payment = $withholding->payment()->first();

        if ($withholding->settlement) {
            $withholding->settlement->delete();
            $payment->updateAmount();
        } 
        $withholding->delete();

        $withholding->nullWithholding()->create([
            'user_id' => Auth::user()->id,
            'reason' => $request->get('annullment_reason')
        ]);

        return redirect()->back()
            ->with('success', '¡Multa anulada!');   
    }
}
