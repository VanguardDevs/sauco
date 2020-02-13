<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepresentationType extends Model
{
    protected $table = 'representation_types';

    protected $fillable = [
        'name'
    ];

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }
}
