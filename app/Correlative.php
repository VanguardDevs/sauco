<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlative extends Model
{
    protected $table = 'correlatives';

    protected $fillable = [
        'num',
        'correlative_type_id',
        'fiscal_year_id'
    ];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function correlativeType()
    {
        return $this->belongsTo(CorrelativeType::class);
    }
}
