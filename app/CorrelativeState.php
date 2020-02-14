<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrelativeState extends Model
{
    protected $table = 'correlative_states';

    protected $fillable = [
        'correlative_id',
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

    public function correlative()
    {
        return $this->belongsTo(Correlative::class);
    }
}
