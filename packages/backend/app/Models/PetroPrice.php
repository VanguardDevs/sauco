<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetroPrice extends Model
{
    use HasFactory;

    protected $table = 'petro_prices';

    protected $fillable = [
        'value',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'value' => 'float'
    ];

    public function appraissals()
    {
        return $this->hasMany(Appraisal::class);
    }
}
