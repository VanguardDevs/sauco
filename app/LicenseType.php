<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    protected $table = 'license_types';

    protected $fillable = [
        'name'
    ];

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
