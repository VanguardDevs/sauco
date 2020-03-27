<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipalities';

    protected $fillable = [
        'name', 'state_id'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function taxpayers()
    {
        return $this->hasMany(Taxpayer::class);
    }
}
