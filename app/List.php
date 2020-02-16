<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{
    protected $table = 'lists';

    protected $guarded = ['name'];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }
}
