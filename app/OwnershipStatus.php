<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnershipStatus extends Model
{
    use HasFactory;

    protected $table = 'ownership_status';

    public function taxpayerProperty()
    {
        return $this->hasMany(TaxpayerProperty::class);
    }
}
