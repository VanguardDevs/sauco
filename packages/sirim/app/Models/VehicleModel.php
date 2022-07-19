<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{

    protected $table = 'vehicle_models';

    protected $fillable = [
        'brand_id',
        'name'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_model_id');
    }
}
