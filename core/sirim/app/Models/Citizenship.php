<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    protected $table = 'citizenships';

    protected $fillable = [
        'description',
        'correlative'
    ];

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }
}
