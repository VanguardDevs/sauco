<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalFirm extends Model
{
    protected $table = 'personal_firms';
    
    protected $fillable = [
        'firm',
        'chargue',
        'resolution_num',
        'resolution_date',
    ];
}
