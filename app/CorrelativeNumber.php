<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrelativeNumber extends Model
{
    protected $table = 'correlative_numbers';

    protected $guarded = [];

    public function correlative()
    {
        return $this->hasMany(Correlative::class);
    }
}
