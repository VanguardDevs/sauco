<?php

namespace App;

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
}
