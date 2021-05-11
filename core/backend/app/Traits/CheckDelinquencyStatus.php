<?php

namespace App\Traits;

use App\Models\Fine;
use App\Models\User;

trait CheckDelinquencyStatus
{
    public function checkForFine()
    {
        $affidavit = $this->liquidations()
            ->whereLiquidableType('App\Models\Affidavit')
            ->first()
            ->liquidable;
        $totalFines = $affidavit->shouldHaveFine();
        $totalLiquidations = $this->liquidations()->count();

        if ($totalFines && $totalLiquidations < 3) {
            $this->applyFine($affidavit, $totalFines);
            $this->updateAmount();

            return $totalFines;
        }

        return null;
    }

    private function applyFine($affidavit, $numLiq)
    {
        $fineAmount = $affidavit->amount * 0.3;
        $userId = User::whereLogin('sauco')->first()->id;

        for($i = $numLiq; $i > 0; $i--) {
            $fine = Fine::create([
                'amount' => $fineAmount,
                'active' => true,
                'taxpayer_id' => $this->taxpayer_id,
                'concept_id' => 3,
                'user_id' => $userId
            ]);

            $fine->affidavit()->attach($affidavit);
            $liquidation = $fine->makeLiquidation();
            $this->liquidations()->attach($liquidation);
        }

        return true;
    }
}
