<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model extends Model
{
    protected $table = 'models';

    protected $fillable = [ 'name' ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
