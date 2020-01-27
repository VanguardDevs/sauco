<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseState extends Model
{
    protected $table = 'license_states';

    protected $fillable = [
        'description'
    ];

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
