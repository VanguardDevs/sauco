<?php

namespace App\Http\Controllers;

use App\Withholding;
use App\Taxpayer;
use App\Affidavit;
use App\Month;
use App\Payment;
use App\Settlement;
use App\Concept;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class WithholdingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taxpayer $taxpayer)
    {
        // $affidavits = $taxpayer->affidavits()->get();
        $months = Month::whereYearId(1)
                ->where('id', '<', Carbon::now()->month)
                ->pluck('name', 'id');

        return view('modules.taxpayers.withholdings.index')
            ->with('taxpayer', $taxpayer)
            ->with('months', $months);
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
        $affidavit = $taxpayer->affidavits()->whereMonthId($request->input('month'))
            ->first();

        $amount = $request->input('amount');
        $settlementAmount = $affidavit->amount - $amount;

        $settlement = $affidavit->settlement()->first();

        if (!$settlement) {
            return redirect()->route('withholdings.index', $taxpayer)
                ->withError('¡La declaración no ha sido facturada!');
        }
        
        $settlement->update([
            'amount' => $settlementAmount
        ]);
        $settlement->payment->updateAmount();

        // Save withholding
        $withholding = $affidavit->withholding()->create([
            'amount' => $amount,
            'affidavit_id' => Auth::user()->id,
            'user_id' => Auth::user()->id
        ]);

        $payment = Payment::create([
            'num' => Payment::newNum(),
            'state_id' => 1,
            'user_id' => $withholding->user_id,
            'amount' => $withholding->amount,
            'payment_method_id' => 1,
            'payment_type_id' => 1,
            'invoice_model_id' => 1,
            'taxpayer_id' => $taxpayer->id
        ]);

        $payment->settlements()->create([
            'num' => Settlement::newNum(),
            'object_payment' =>  $this->message($affidavit),
            'withholding_id' => $withholding->id,
            'amount' => $withholding->amount
        ]);

        return redirect()->route('withholdings.index', $taxpayer)
            ->withSuccess('¡Retención procesada!');
    }

    public function message(Affidavit $affidavit)
    {
        $conceptName = Concept::whereCode(5)->first()->name;
        $monthYear = $affidavit->month->name.' - '.$affidavit->month->year->year;

        return $conceptName.': '.$monthYear;
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
    public function destroy(Withholding $withholding)
    {
        //
    }
}
