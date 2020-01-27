<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $table = 'property_types';

    protected $fillable = [
        'classification',
        'denomination',
        'amount',
        'charging_method_id'
    ];

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
