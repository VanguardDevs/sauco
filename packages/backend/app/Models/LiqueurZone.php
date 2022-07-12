<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiqueurZone extends Model
{
    protected $table = 'liqueur_zones';

    protected $fillable = [
        'name'
    ];

    public function liqueur_parameters()
    {
        return $this->hasMany(LiqueurParameter::class, 'liqueur_zone_id');
    }
}
