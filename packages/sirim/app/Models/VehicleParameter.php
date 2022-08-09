<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleParameter extends Model
{
    protected $table = 'vehicle_parameters';

    protected $fillable = [
        'name'
    ];

    public function vehicleClassifications()
    {
        return $this->hasMany(VehicleClassification::class, 'vehicle_parameter_id');
    }

    public function scopeClassificationsByList($query, $type)
    {
        return self::vehicleClassifications()
            ->where('vehicle_parameter_id', $type)
            ->get();
    }
}
