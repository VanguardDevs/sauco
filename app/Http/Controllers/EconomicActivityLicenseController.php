<?php

namespace App\Http\Controllers;

use App\Correlative;
use App\CorrelativeType;
use App\EconomicActivityLicense;
use App\FiscalYear;
use App\LicenseState;
use App\OldLicense;
use App\Taxpayer;
use App\Payment;
use App\PaymentState;
use App\PaymentType;
use App\Concept;
use App\Month;
use App\Settlement;
use App\TaxUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EconomicActivityLicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function renewOldLicense($licenseID, $taxpayerID)
    {
        $taxpayer = Taxpayer::find($taxpayerID);
        $oldCorrelative = OldLicense::find($licenseID)->correlative;
        $correlativeType = CorrelativeType::whereDescription('R-')->first();
        $currYear = FiscalYear::where('year', '2020')->first();
        $licenseState = LicenseState::whereDescription('ACTIVA')->first();
        $oldLicense = OldLicense::find($licenseID);

        $correlative = Correlative::create([
            'num' => $oldCorrelative,
            'correlative_type_id' => $correlativeType->id,
            'fiscal_year_id' => $currYear->id
        ]);

        $emissionDate = Carbon::now();
        $expirationDate = $emissionDate->copy()->endOfYear();
        $num = $oldLicense->num;

        $license = new EconomicActivityLicense([
            'num' => $num,
            'emission_date' => $emissionDate,
            'expiration_date' => $expirationDate,
            'correlative_id' => $correlative->id,
            'taxpayer_id' => $taxpayer->id,
            'license_state_id' => $licenseState->id,
            'settlement_id' => '1'
        ]);
        $license->save();

        return redirect('applications')
            ->withSucces('¡Licencia aprobada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EconomicActivityLicense  $economicActivityLicense
     * @return \Illuminate\Http\Response
     */
    public function show($economicActivityLicense, $taxpayer)
    {
        $taxpayer = Taxpayer::find($taxpayer);
        $economicActivityLicense = EconomicActivityLicense::find($economicActivityLicense);

        /**
         * Step 1: Look for settlement and payment num
         */
        if (Payment::lastPayment()->count()) {
            $lastNum = Payment::lastPayment()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $payNum = str_pad($newNum,8,"0",STR_PAD_LEFT);
        } else {
            $payNum = "00000001";
        }

        if (Settlement::lastSettlement()->count()) {
            $lastNum = Settlement::lastSettlement()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $settlementNum = str_pad($newNum,8,"0",STR_PAD_LEFT);
        } else {
            $settlementNum = "00000001";
        }

        /**
         * Step 2: Look for data
         */
        $concept = Concept::find('IMPUESTO POR ACTIVIDAD ECONÓMICA');
        $state = PaymentState::whereDescription('PENDIENTE')->first();
        $applicationState = ApplicationState::whereDescription('PENDIENTE')->first();
        $type = PaymentType::whereDescription('S/N')->first();
        $month = Month::find(Carbon::now()->month);
        $currentUT = TaxUnit::latest()->first();

        $amount = 0;
        $totalAmount = 0;

        /**
         * Make a payment
         */
        $payment = Payment::create([
            'num' => $payNum,
            'amount' => $amount,
            'total_amount' => $amount,
            'payment_state_id' => $state->id,
            'payment_type_id' => $type->id,
            'user_id' => Auth::id()
        ]);

        // foreach ($taxpayer->economicActivities as $activity) {
        //     Settlement::create([
        //         'num' => ,
        //         'amount' => ,
        //         'payment_id' => ,
        //         'concept_id' => ,
        //         'taxpayer_id' => ,
        //         'month_id' => $mon
        //     ]);
        // }

        return view('modules.licenses.show')
            ->with('row', $economicActivityLicense)
            ->with('taxpayer', $taxpayer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EconomicActivityLicense  $economicActivityLicense
     * @return \Illuminate\Http\Response
     */
    public function edit(EconomicActivityLicense $economicActivityLicense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EconomicActivityLicense  $economicActivityLicense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EconomicActivityLicense $economicActivityLicense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EconomicActivityLicense  $economicActivityLicense
     * @return \Illuminate\Http\Response
     */
    public function destroy(EconomicActivityLicense $economicActivityLicense)
    {
        //
    }
}
