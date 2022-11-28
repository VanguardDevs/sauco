<?php

namespace App\Traits;

use App\Models\RequirementTaxpayer;
use App\Models\Liqueur;
use App\Models\Vehicle;

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
            $code = $this->concept->code;

            // Check for renovation
            $this->associateModelToLicense($license, $code);
            switch($code) {
                case '21':
                case '22':
                    if ($license->active == false && $license->liqueur != null) {
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

    public function updateVehicleStatus()
    {
        $license = $this->license;

        $vehicle = Vehicle::whereLicenseId($license->id)->first();

        // Vehicle
        if ($license) {
            $code = $this->concept->code;

            switch($code) {
                case '15':
                    if ($license->active == false && $vehicle != null) {
                        $license->update([
                            'active' => true
                        ]);

                        $vehicle->update([
                            'status' => true
                        ]);
                    }
                    break;
                default:
                    return;
            }
        }

        return;

    }

    public function addTaxpayerRequirement()
    {
        $data = Array();

        switch($this->concept->code) {
            case '001.005.000':
            case '001.005.001':
                    $data['requirement_id'] = $this->concept->requirement->id;
                    $data['liquidation_id'] = $this->id;
                    $data['active'] = true;
                break;
            case '00.00.00.00':
                   $this->taxpayer->requirementTaxpayer()->where('liquidation_id', $this->id)->update(['active' => false]);
                break;
            default:
                break;
        }

        if ($data != null) {
            $this->taxpayer->requirementTaxpayer()->create($data);
        }
    }

    private function associateModelToLicense($license, $code)
    {
        switch($code) {
            case '22':
                $liqueur = Liqueur::whereNum($license->num)->first();

                if ($liqueur) {
                    $liqueur->update([
                        'license_id' => $license->id
                    ]);
                }
                break;
            default:
                break;
        }
    }
}
