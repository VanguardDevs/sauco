<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxpayerType extends Model
{
    protected $table = 'taxpayer_types';

    protected $fillable = [
        'description',
        'correlative'
    ];

    public function taxpayers()
    {
        return $this->hasMany(Taxpayer::class);
    }
}
