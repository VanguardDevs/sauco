<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FineType extends Model
{
    protected $table = 'fine_types';

    protected $fillable = [
        'law',
        'value',
        'publication_date',
        'description',
        'charging_method_id'
    ];

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }

    public function setPublicationDateAttribute($value)
    {
        $this->attributes['publication_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function getPublicationDateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
