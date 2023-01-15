<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'years';

    protected $fillable = [
        'year'
    ];

    public function months()
    {
        return $this->hasMany(Month::class);
    }

    public function vehicleCorrelatives()
    {
        return $this->hasMany(Correlative::class);
    }


    public function correlatives()
    {
        return $this->hasMany(Correlative::class);
    }
}
