<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxpayer;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MakeWithholdingRequest;
use App\Models\Liquidation;
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
    public function show(Liquidation $liquidation)
    {
        if ($liquidation->liquidation_type_id == 1
            && !($liquidation->deduction()->exists())
            && ($liquidation->payment->state_id == 1)) {
            $this->typeForm = 'update';
        }

        return view('modules.taxpayers.liquidations.show')
            ->with('taxpayer', $liquidation->taxpayer)
            ->with('row', $liquidation)
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
    public function update(MakeWithholdingRequest $request, Liquidation $liquidation)
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
