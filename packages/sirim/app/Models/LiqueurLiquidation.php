<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiqueurLiquidation extends Model
{

    protected $table = 'liqueur_liquidation';

    protected $fillable = [
        'liqueur_id',
        'liquidation_id'
    ];


    public function liqueur()
    {
        return $this->belongsTo(Liqueur::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
