<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NullApplication extends Model
{
    protected $table = 'null_applications';

    protected $fillable = [
        'reason',
        'user_id',
        'application_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class)
            ->onlyTrashed();
    }
}
