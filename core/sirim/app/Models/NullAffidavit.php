<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NullAffidavit extends Model
{
    protected $table = 'null_affidavits';

    protected $fillable = [
        'reason',
        'user_id',
        'affidavit_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function affidavit()
    {
        return $this->hasOne(Affidavit::class);
    }
}
