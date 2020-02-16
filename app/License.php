<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class License extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'licenses';

    protected $fillable = [
        'emission_date',
        'taxpayer_id',
        'correlative_id',
        'ordinance_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function correlative()
    {
        return $this->belongsTo(Correlative::class);
    }

    public function ordinance()
    {
        return $this->belongsTo(Ordinance::class);
    }

    public function scopeGetLastLicense($query, Taxpayer $taxpayer)
    {
        $license = self::whereTaxpayerId($taxpayer->id);

        if ($license->count()) {
            return $license;
        }    
    }
}
