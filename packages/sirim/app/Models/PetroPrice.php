<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyTimestamps;

class PetroPrice extends Model
{
    use PrettyTimestamps;

    protected $table = 'petro_prices';

    protected $fillable = [
        'value'
    ];

    protected $casts = [
        'value' => 'float'
    ];

    public function appraissals()
    {
        return $this->hasMany(Appraisal::class);
    }
}
