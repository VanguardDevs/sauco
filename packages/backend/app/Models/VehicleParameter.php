<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleParameter extends Model
{
    use HasFactory;

    protected $table = 'vehicle_parameters';

    protected $fillable = [
        'name',
        'years',
        'weight',
        'capacity',
        'stalls'
    ];

    public function vehicle_classifications()
    {
        return $this->hasMany(VehicleClassification::class, 'vehicle_parameter_id');
    }
}
