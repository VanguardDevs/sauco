<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [ 'name' ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'brand_id');
    }

    public function models()
    {
        return $this->hasMany(VehicleModel::class, 'brand_id');
    }
}
