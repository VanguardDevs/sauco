<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnexedLiqueur extends Model
{
    use HasFactory;

    protected $table = 'annexed_liqueurs';

    protected $fillable = [
        'name'
    ];

    public function liqueur_annexes()
    {
        return $this->hasMany(LiqueurAnnex::class, 'annex_id');
    }
}
