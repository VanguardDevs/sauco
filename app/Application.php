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
        'object_payment',
        'approved_date',
        'description',
        'answer_date',
        'ordinance_id',
        'payment_id'
    ];

    public function ordinance()
    {
        return $this->belongsTo(Ordinance::class);
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
