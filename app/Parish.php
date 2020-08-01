<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    protected $table = 'parishes';

    protected $fillable = ['name'];

    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function taxpayers()
    {
        return $this->hasMany(Taxpayer::class);
    }
}
