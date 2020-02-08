<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
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
