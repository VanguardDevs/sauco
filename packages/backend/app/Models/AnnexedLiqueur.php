<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnexedLiqueur extends Model
{
    protected $table = 'annexed_liqueurs';

    protected $fillable = [
        'name'
    ];

    public function liqueurAnnexes()
    {
        return $this->hasMany(LiqueurAnnex::class, 'annex_id');
    }

    public function liqueurs()
    {
        return $this->belongsToMany(
            Liqueur::class,
            'liqueur_annexes',
            'annex_id'
        );
    }
}
