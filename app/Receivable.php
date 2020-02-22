<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    use SoftDeletes;

    protected $table = 'receivables';

    protected $guarded = [];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function settlements()
    {
        return $this->belongsTo(Settlement::class);
    }
}
