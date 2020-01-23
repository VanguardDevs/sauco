<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CommercialRegister extends Model
{
    protected $table = 'commercial_registers';

    protected $fillable = [
        'num',
        'volume',
        'case_file',
        'start_date'
    ];

    public function taxpayer()
    {
        return $this->hasOne(Taxpayer::class);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function getStartDateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
