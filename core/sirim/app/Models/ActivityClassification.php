<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityClassification extends Model
{
    use SoftDeletes;

    protected $table = 'activity_classifications';
    
    protected $fillable = ['name'];

    public function economicActivities()
    {
        return $this->hasMany(EconomicActivity::class);
    }
}
