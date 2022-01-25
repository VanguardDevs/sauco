<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liquerparameters extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'new_registry_amount',
        'renew_registry_amount',
        'movil',
    ];

    public function liquerclassifications()
    {
        return $this->hasOne(liquerclassifications::class);
    }

    public function liquerzone()
    {
        return $this->hasOne(liquerzone::class);
    }
}
