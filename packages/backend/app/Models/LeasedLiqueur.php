<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeasedLiqueur extends Model
{
    use HasFactory;

    protected $table = 'leased_liqueurs';

    protected $fillable = [
        'lessor',
        'lessee',
        'date_from',
        'date_until',
        'liqueur_id'
    ];

    public function liqueurs()
    {
        return $this->belongsTo(Liqueur::class);
    }
}
