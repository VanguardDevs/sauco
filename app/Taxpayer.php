<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxpayer extends Model
{
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
        'commercial_register_id',
        'representation_id'
    ];

    public function representation()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function economicSector()
    {
        return $this->belongsTo(EconomicSector::class);
    }

    public function commercialRegister()
    {
        return $this->belongsTo(CommercialRegister::class);
    }

    public function taxpayerType()
    {
        return $this->belongsTo(CommercialRegister::class);
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
}
