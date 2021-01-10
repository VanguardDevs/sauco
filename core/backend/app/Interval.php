<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    protected $table = 'intervals';

    protected $fillable = [
        'name'
    ];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }
}
