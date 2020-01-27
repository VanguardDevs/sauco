<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommercialRegister extends Model
{
    use SoftDeletes;

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
