<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationState extends Model
{
    protected $table = 'application_states';

    protected $fillable = ['description'];
}
