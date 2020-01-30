<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdinanceType extends Model
{
    protected $table = 'ordinance_types';

    protected $fillable = [
        'description'
    ];

    public function ordinances()
    {
        return $this->hasMany(Ordinance::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
