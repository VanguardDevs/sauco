<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use SoftDeletes;

    protected $table = 'licenses';

    protected $fillable = [
        'license_type_id',
        'license_state_id',
        'property_id'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function licenseType()
    {
        return $this->belongsTo(LicenseType::class);
    }

    public function licenseState()
    {
        return $this->belongsTo(LicenseState::class);
    }
}
