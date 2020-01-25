<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargingMethod extends Model
{
    protected $table = 'charging_methods';

    protected $fillable = [
        'name'
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
