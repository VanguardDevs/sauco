<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialDenomination extends Model
{
    protected $table = 'commercial_denominations';

    protected $fillable = [
        'name',
        'taxpayer_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }
}
