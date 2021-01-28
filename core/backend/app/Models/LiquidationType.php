<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiquidationType extends Model
{
    protected $table = 'liquidation_types';

    protected $fillable = ['name'];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    public function liquidations()
    {
        return $this->hasMany(Liquidation::class);
    }
}
