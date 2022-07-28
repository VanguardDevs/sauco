<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'plate',
        'body_serial',
        'engine_serial',
        'weight',
        'capacity',
        'stalls',
        'taxpayer_id',
        'vehicle_model_id',
        'color_id',
        'vehicle_classification_id',
        'license_id'
    ];

    public function vehicleClassification()
    {
        return $this->belongsTo(VehicleClassification::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

}
