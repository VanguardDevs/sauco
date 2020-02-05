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
        'payment_id'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
