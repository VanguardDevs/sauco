<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Application extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'applications';

    protected $fillable = [
        'answer_date',
        'application_state_id',
        'settlement_id'
    ];

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }

    public function applicationState()
    {
        return $this->belongsTo(ApplicationState::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
