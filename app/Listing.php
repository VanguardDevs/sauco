<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'lists';

    protected $guarded = ['name'];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }
}
