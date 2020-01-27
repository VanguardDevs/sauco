<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnershipStatus extends Model
{
    protected $table = 'ownership_statuses';

    protected $fillable = [
        'description'
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
