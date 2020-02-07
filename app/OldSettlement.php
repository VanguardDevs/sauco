<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldSettlement extends Model
{
    protected $table = 'old_settlements';

    protected $fillable = [
        'num',
        'old_license_id'
    ];

    public function oldLicense()
    {
        return $this->hasOne(OldLicense::class);
    }
}
