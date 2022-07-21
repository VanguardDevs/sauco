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
        'weight_from',
        'weight_until',
        'stalls_from',
        'stalls_until',
        'capacity_from',
        'capacity_until',
        'vehicle_parameter_id',
        'charging_method_id'
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_classification_id');
    }

    public function vehicle_parameter()
    {
        return $this->belongsTo(VehicleParameter::class);
    }

    public function charging_method()
    {
        return $this->belongsTo(ChargingMethod::class);
    }
}
