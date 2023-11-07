<?php

namespace App\Traits;

use App\Models\RequirementTaxpayer;
use App\Models\Liqueur;

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
                case 'OTA.2023.057':
                case 'OTA.2023.059':
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

    public function addTaxpayerRequirement()
    {
        $data = Array();

        switch($this->concept->code) {
            // Solicitud Instalacion
            case 'OTA.2023.056':

            // Solicitud Renovacion
            case 'OTA.2023.058':
                    $data['requirement_id'] = $this->concept->requirement->id;
                    $data['liquidation_id'] = $this->id;
                    $data['active'] = true;
                break;


            // Codigo Multa    
            case '009.009.009':
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
            case 'OTA.2023.059':    
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
