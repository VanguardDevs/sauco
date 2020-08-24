<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargingMethod extends Model
{
    protected $table = 'charging_methods';

    protected $fillable = [
        'name'
    ];

    public function conceptPrices()
    {
        return $this->hasMany(ConceptPrice::class);
    }

    public function propertyTypes()
    {
        return $this->hasMany(PropertyType::class);
    }

    public function ordinances()
    {
        return $this->hasMany(Ordinance::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
