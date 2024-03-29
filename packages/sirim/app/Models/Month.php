<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'months';

    protected $fillable = [
        'name',
        'start_period_at',
        'year_id'
    ];

    protected $with = [ 'year' ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function affidavits()
    {
        return $this->hasMany(Affidavit::class);
    }
}
