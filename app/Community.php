<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';

    protected $fillable = ['name'];

    public function parishes()
    {
        return $this->belongsToMany(Parish::class);
    }
}
