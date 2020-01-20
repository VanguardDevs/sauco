<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EconomicActivity extends Model
{
    protected $table = 'economic_activities';

    protected $fillable = [
        'code',
        'name',
        'aliquote',
        'min_tax'
    ];
}
