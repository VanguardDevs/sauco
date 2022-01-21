<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUse extends Model
{
    use HasFactory;

    protected $table = 'property_uses';

    protected $fillable = [
        'name',
        'value'
    ];
}
