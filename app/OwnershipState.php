<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnershipState extends Model
{
    protected $table = 'ownership_states';

    protected $fillable = [
        'description'
    ];

    public function taxpayerProperty()
    {
        return $this->hasMany(Property::class);
    }
}
