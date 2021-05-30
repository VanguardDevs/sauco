<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargingMethod extends Model
{
    protected $table = 'charging_methods';

    protected $fillable = [
        'name'
    ];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }
}
