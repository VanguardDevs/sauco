<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [ 'name' ];

    public function vehicleModels()
    {
        return $this->hasMany(VehicleModel::class, 'brand_id');
    }

    public function scopeModelsByList($query, $type)
    {
        return self::vehicleModels()
            ->where('brand_id', $type)
            ->get();
    }
}
