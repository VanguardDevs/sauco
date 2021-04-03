<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaxUnit extends Model
{
    protected $table = 'tax_units';

    protected $fillable = [
        'law',
        'value',
        'publication_date'
    ];

    public function setPublicationDateAttribute($value)
    {
        $this->attributes['publication_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function getPublicationDateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
