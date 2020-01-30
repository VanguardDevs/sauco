<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $table = 'fiscal_years';

    protected $fillable = [
        'year'
    ];

    public function months()
    {
        return $this->hasMany(Month::class);
    }

    public function correlatives()
    {
        return $this->hasMany(Correlative::class);
    }
}
