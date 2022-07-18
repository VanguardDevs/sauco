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
        'status',
        'weight',
        'capacity',
        'stalls',
        'taxpayer_id',
        'model_id',
        'color_id',
        'vehicle_use_id',
        'vehicle_classification_id'
    ];

    public function vehicle_use()
    {
        return $this->belongsTo(VehicleUse::class);
    }

    public function vehicle_classification()
    {
        return $this->belongsTo(VehicleClassification::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

}
