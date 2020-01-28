<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fine extends Model
{
    use SoftDeletes;

    protected $table = 'fines';

    protected $fillable = [
        'observations',
        'fine_type_id',
        'fine_state_id',
        'payment_id'
    ];

    public function fineType()
    {
        return $this->belongsTo(FineType::class);
    }

    public function fineState()
    {
        return $this->belongsTo(FineState::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
