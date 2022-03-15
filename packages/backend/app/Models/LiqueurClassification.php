<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiqueurClassification extends Model
{
    use HasFactory;

    protected $table = 'liqueur_classifications';

    protected $fillable = [
        'name',
        'abbreviature'
    ];

    public function liqueur_parameters()
    {
        return $this->hasMany(LiqueurParameter::class, 'liqueur_classification_id');
    }
}
