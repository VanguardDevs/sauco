<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomicActivityLicense extends Model
{
    use SoftDeletes;

    protected $table = 'economic_activity_licenses';

    protected $fillable = [
        'emission_date',
        'expiration_date',
        'license_id',
        'correlative_id'
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function correlative()
    {
        return $this->belongsTo(Correlative::class);
    }
}
