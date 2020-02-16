<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlative extends Model
{
    use SoftDeletes;
    protected $table = 'correlatives';

    protected $fillable = [
        'correlative_num_id',
        'correlative_type_id',
        'fiscal_year_id'
    ];

    public function correlativeType()
    {
        return $this->belongsTo(CorrelativeType::class);
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function correlativeNumber()
    {
        return $this->belongsTo(CorrelativeNumber::class);
    }
}
