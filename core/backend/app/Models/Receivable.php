<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    use HasFactory;

    protected $table = 'receivables';

    protected $table = [
        'amount',
        'liquidation_id'
    ];

    public function payment()
    {
        return $this->belongsToMany(Payment::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
