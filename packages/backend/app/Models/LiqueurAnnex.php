<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiqueurAnnex extends Model
{
    protected $table = 'liqueur_annexes';

    protected $fillable = [
        'annex_id',
        'liqueur_id'
    ];

    public function liqueurs()
    {
        return $this->belongsTo(Liqueur::class);
    }

    public function annexes()
    {
        return $this->belongsTo(AnnexedLiqueur::class);
    }
}
