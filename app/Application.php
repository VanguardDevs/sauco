<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $table = 'applications';

    protected $fillable = [
        'description',
        'approved_date',
        'application_state_id',
        'application_type_id',
        'user_id',
        'taxpayer_id'
    ];

    public function applicationState()
    {
        return $this->belongsTo(ApplicationState::class);
    }

    public function type()
    {
        return $this->belongsTo(ApplicationType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function applicationType()
    {
        return $this->belongsTo(ApplicationType::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
