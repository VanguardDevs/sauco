<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConceptPrice extends Model
{
    protected $table = 'concept_prices';

    protected $guarded = [];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }
}
