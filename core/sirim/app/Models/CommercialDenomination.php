<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommercialDenomination extends Model
{
    use SoftDeletes;

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
