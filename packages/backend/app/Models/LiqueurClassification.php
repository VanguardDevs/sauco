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

    public function liqueur_parametres()
    {
        return $this->hasMany(LiqueurParametre::class, 'liqueur_classification_id');
    }
}
