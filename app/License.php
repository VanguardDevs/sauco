<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use SoftDeletes;

    protected $table = 'licenses';

    protected $fillable = [
        'num',
        'taxpayer_id',
        'license_state_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function licenseState()
    {
        return $this->belongsTo(LicenseState::class);
    }
}
