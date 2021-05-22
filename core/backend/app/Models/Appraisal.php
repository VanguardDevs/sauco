<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appraisal extends Model
{
    use SoftDeletes;

    protected $table = 'appraisals';

    protected $fillable = [
        'amount',
        'user_id',
        'property_id',
        'petro_price_id',
        'year_id'
    ];

    public function property()
    {
        return $this->hasOne(Property::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function year()
    {
        return $this->hasOne(Year::class);
    }

    public function petroPrice()
    {
        return $this->belongsTo(PetroPrice::class);
    }

    public function liquidation()
    {
        return $this->morphOne(Liquidation::class, 'liquidable')
            ->withTrashed();
    }
}
