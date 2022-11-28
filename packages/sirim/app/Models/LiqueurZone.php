<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiqueurZone extends Model
{
    protected $table = 'liqueur_zones';

    protected $fillable = [
        'name'
    ];

    public function liqueurParameters()
    {
        return $this->hasMany(LiqueurParameter::class, 'liqueur_zone_id');
    }
}
