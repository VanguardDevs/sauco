<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordinance extends Model
{
    protected $table = 'ordinances';

    protected $fillable = [
        'description'
    ];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function scopeConceptsByList($query, $type)
    {
        return self::concepts()
            ->where('liquidation_type_id', '=', $type)
            ->where('deleted_at', '=', null)
            ->get();
    }


    public function scopeConceptsByOrdinance($query, $type)
    {
        return self::concepts()
            ->where('ordinance_id', '=', $type)
            ->get();
    }
}
