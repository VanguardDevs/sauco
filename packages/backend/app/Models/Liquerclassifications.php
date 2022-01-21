<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquerclassifications extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'abbreviature'
    ];

    public function liquerParameters() {
        return $this->hasMany(Liquer::class);
    }
}
