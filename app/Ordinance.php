<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Ordinance extends Model
{
    // use SoftDeletes;

    protected $table = 'ordinances';

    protected $fillable = [
        'law',
        'value',
        'description',
        'publication_date',
        'charging_method_id',
        'ordinance_type_id'
    ];

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }

    public function ordinanceType()
    {
        return $this->belongsTo(OrdinanceType::class);
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
