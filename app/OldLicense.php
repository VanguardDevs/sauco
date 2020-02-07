<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldLicense extends Model
{
    protected $table = 'old_licenses';

    protected $fillable = [
        'rif',
        'num',
        'correlative'
    ];

    public function oldSettlements()
    {
        return $this->hasMany(OldSettlement::class);
    }
}
