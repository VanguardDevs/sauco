<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
    protected $table = 'application_types';

    protected $fillable = ['description'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}