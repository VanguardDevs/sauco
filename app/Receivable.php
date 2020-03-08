<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Receivable extends Model implements Auditable
{
    use SoftDeletes;
    use Audit;

    protected $table = 'receivables';

    protected $guarded = [];

    public function payments()
    {
        return $this->belongsTo(Payment::class);
    }

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }

    public function taxpayer()
    {
        return $this->hasOneThrough(Taxpayer::class, Settlement::class, 'taxpayer_id', 'id');
    }
}
