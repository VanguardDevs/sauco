<?php

namespace app\Services;

use App\License;
use App\Correlative;
use App\CorrelativeNumber;
use App\CorrelativeType;
use App\Year;
use Carbon\Carbon;
use App\Ordinance;
use App\Taxpayer;

class LicenseService {
    /*
     * General service for Licenses manipulation
     */

    public function makeLicense(CorrelativeType $type, Taxpayer $taxpayer)
    {
        $currYear = Year::where('year', Carbon::now()->year)->first();
        $correlativeNum = CorrelativeNumber::getNum();
        // Maybe for other kind of licenses, I would inject
        // Ordinances in this method and make licences without searching for
        // a model
        $ordinance = Ordinance::whereDescription('ACTIVIDAD ECONÓMICA')->first();
        $emissionDate = Carbon::now();
         
        $correlativeNumber = CorrelativeNumber::create([
            'num' => $correlativeNum
        ]);

        $correlative = Correlative::create([
            'year_id' => $currYear->id,
            'correlative_type_id' => $type->id,
            'correlative_number_id' => $correlativeNumber->id
        ]);    

        $license = License::create([
            'num' => $correlative->num, 
            'emission_date' => $emissionDate,
            'ordinance_id' => $ordinance->id,
            'correlative_id' => $correlative->id,
            'taxpayer_id' => $taxpayer->id
        ]);

        return $license;
    }
}
