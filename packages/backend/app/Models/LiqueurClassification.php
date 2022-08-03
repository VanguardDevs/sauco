<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiqueurClassification extends Model
{
    protected $table = 'liqueur_classifications';

    protected $fillable = [
        'name',
        'abbreviature'
    ];

    public function liqueurParameters()
    {
        return $this->hasMany(LiqueurParameter::class, 'liqueur_classification_id');
    }

    public function liqueurs()
    {
        return $this->hasMany(Liqueur::class);
    }
}
