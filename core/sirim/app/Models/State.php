<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [ 'name', 'code' ];

    public function taxpayers()
    {
        return $this->hasManyThrough(Taxpayer::class, Municipality::class);
    }

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
