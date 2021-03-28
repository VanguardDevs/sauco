<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldPayment extends Model
{
    protected $table = 'old_payments';

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }
}
