<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cubicle extends Model
{
    use HasFactory;

    protected $table = 'cubicles';

    public function item()
    {
        $this->belongsTo(Item::class);
    }
}
