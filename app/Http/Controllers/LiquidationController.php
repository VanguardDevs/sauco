<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taxpayer;
use App\Settlement;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MakeWithholdingRequest;
use Auth;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Settlement $settlement)
    {
        if ($settlement->affidavit()->exists()
            && !($settlement->affidavit->withholding()->exists())
            && ($settlement->payment->state_id == 1)) {
            $this->typeForm = 'update';
        }

        return view('modules.taxpayers.liquidations.show')
            ->with('taxpayer', $settlement->taxpayer)
            ->with('row', $settlement)
            ->with('typeForm', $this->typeForm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(MakeWithholdingRequest $request, Settlement $liquidation)
    {
        // Substract amount
        $amount = $request->input('withholding_amount');
        $newLiquidationAmount = $liquidation->amount - $amount;
        $affidavit = $liquidation->affidavit;

        if ($amount == 0 || $newLiquidationAmount == 0 || $newLiquidationAmount < 0) {
            return redirect()->back()
                ->withErrors([
                    'withholding_amount' => 'El monto especificado excede el total de la liquidación.'
                ]);
        }

        // Save withholding
        $withholding = $affidavit->withholding()->create([
            'amount' => $amount,
            'affidavit_id' => $affidavit->id,
            'user_id' => Auth::user()->id
        ]);
 	
	    $liquidation->update([
            'amount' => $newLiquidationAmount,
            'withholding_id' => $withholding->id
        ]);

        $liquidation->payment->updateAmount();

        return redirect()->back()
            ->withSuccess('¡Retención de '.$withholding->amount.' aplicada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
