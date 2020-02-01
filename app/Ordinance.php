<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordinance extends Model
{
    protected $table = 'ordinances';

    protected $fillable = [
        'description'
    ];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
