<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EconomicSector extends Model
{
    protected $table = 'economic_sectors';

    protected $fillable = ['description'];
}
