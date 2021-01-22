<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
