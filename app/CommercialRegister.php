<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class CommercialRegister extends Model implements Auditable
{
    use SoftDeletes;
    use Audit;

    protected $table = 'commercial_registers';

    protected $fillable = [
        'num',
        'volume',
        'case_file',
        'start_date',
        'taxpayer_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
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
