<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxpayer extends Model
{
    use SoftDeletes;

    protected $table = 'taxpayers';

    protected $fillable = [
        'rif',
        'name',
        'denomination',
        'address',
        'permanent_status',
        'capital',
        'compliance_use',
        'phone',
        'email',
        'taxpayer_type_id',
        'economic_sector_id',
        'municipality_id'
    ];

    public function representation()
    {
        return $this->hasOne(Representation::class);
    }

    public function economicSector()
    {
        return $this->belongsTo(EconomicSector::class);
    }

    public function commercialRegister()
    {
        return $this->hasOne(CommercialRegister::class);
    }

    public function taxpayerType()
    {
        return $this->belongsTo(TaxpayerType::class);
    }

    public function economicActivities()
    {
        return $this->belongsToMany(EconomicActivity::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
