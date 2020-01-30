<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordinance extends Model
{
    use SoftDeletes;

    protected $table = 'applications';

    protected $fillable = [
        'description',
        'charging_method_id',
        'ordinance_type_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }

    public function ordinanceType()
    {
        return $this->belongsTo(OrdinanceType::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
