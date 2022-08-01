<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleClassification extends Model
{

    protected $table = 'vehicle_classifications';

    protected $fillable = [
        'name',
        'amount',
        'vehicle_parameter_id',
        'charging_method_id'
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_classification_id');
    }

    public function vehicleParameter()
    {
        return $this->belongsTo(VehicleParameter::class);
    }

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }
}
