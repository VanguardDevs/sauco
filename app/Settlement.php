<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settlement extends Model
{
    use SoftDeletes;

    protected $table = [
        'num',
        'description',
        'license_id',
        'payment_id',
        'concept_id'
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function economicActivitySettlement()
    {
        return $this->hasOne(EconomicActivitySettlement::class);
    }
}
