<?php

namespace App\Traits;

use App\Models\RequirementTaxpayer;

trait CheckLicense
{
    /**
     * Update license status if applicable
     */
    public function updateLicenseStatus()
    {
        $license = $this->license;

        // Liqueurs
        if ($license) {
            switch($this->concept->code) {
                case '21':
                case '22':
                    if ($license->active == false && $license->liqueur != null ) {
                        $license->update([
                            'active' => true
                        ]);
                    }
                    break;
                default:
                    return;
            }
        }

        return;
    }

    public function checkRequirements()
    {
        $data = Array();

        switch($this->concept->code) {
            case '001.005.000':
            case '001.005.001':
                    $data['requirement_id'] = $this->concept->requirement->id;
                    $data['liquidation_id'] = $this->id;
                    $data['active'] = true;
                break;
            default:
                break;
        }

        $this->taxpayer->requirementTaxpayer()->create($data);
    }
}
