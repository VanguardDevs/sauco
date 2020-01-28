<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
    protected $table = 'application_types';

    protected $fillable = [
        'law',
        'value',
        'publication_date',
        'description',
        'charging_method_id'
    ];

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
