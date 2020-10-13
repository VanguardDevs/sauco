<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';

    protected $fillable = ['name'];

    protected $appends = [
        'num_taxpayers',
        'parish_names'
    ];

    public function streets()
    {
        return $this->belongsToMany(Street::class);
    }

    public function parishes()
    {
        return $this->belongsToMany(Parish::class);
    }

    public function taxpayers()
    {
        return $this->hasMany(Taxpayer::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function getParishNamesAttribute()
    {
        return $this->parishes()->get()->implode('name', ', ');
    }

    public function getNumTaxpayersAttribute()
    {
        return $this->taxpayers()->count();
    }
}
