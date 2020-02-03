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
        'answer_date',
        'concept_id',
        'payment_id'
    ];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
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
