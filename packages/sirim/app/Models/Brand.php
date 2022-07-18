<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [ 'name' ];

    public function vehicle_models()
    {
        return $this->hasMany(VehicleModel::class, 'brand_id');
    }
}
