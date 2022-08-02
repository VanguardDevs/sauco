<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LeasedLiqueur extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leased_liqueurs';

    protected $fillable = [
        'liqueur_id',
        'leaser_id',
        'since',
        'until',
    ];

    public function liqueur()
    {
        return $this->belongsTo(Liqueur::class);
    }

    public function leaser()
    {
        return $this->belongsTo(Taxpayer::class);
    }
}
