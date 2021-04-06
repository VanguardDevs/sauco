<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'lists';

    protected $fillable = ['name'];

    public function concepts()
    {
        return $this->hasMany(Concept::class, 'list_id');
    }

    public function settlements()
    {
        return $this->hasManyThrough(Settlement::class, Concept::class, 'list_id');
    }
}
