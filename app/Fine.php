<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Fine extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'fines';

    protected $fillable = [
        'fine_state_id',
        'settlement_id'
    ];

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }

    public function fineState()
    {
        return $this->belongsTo(FineState::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
