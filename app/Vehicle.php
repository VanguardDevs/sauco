<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'plate'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }
}
