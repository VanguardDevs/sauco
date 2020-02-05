<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'months';

    protected $fillable = [
        'name',
        'fiscal_year_id'
    ];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function months()
    {
        return $this->hasMany(Month::class);
    }
}
