<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomicActivityLicense extends Model
{
    use SoftDeletes;

    protected $table = 'economic_activity_licenses';

    protected $fillable = [
        'num',
        'emission_date',
        'expiration_date',
        'taxpayer_id',
        'correlative_id',
        'license_state_id',
        'settlement_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function correlative()
    {
        return $this->belongsTo(Correlative::class);
    }

    public function licenseState()
    {
        return $this->belongsTo(LicenseState::class);
    }

    public function economicActivitySettlements()
    {
        return $this->hasMany(EconomicActivitySettlement::class);
    }
}
