<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrelativeType extends Model
{

    protected $table = 'correlative_types';

    protected $fillable = [
        'description'
    ];

    public function correlativeStates()
    {
        return $this->hasMany(CorrelativeState::class);
    }
}
