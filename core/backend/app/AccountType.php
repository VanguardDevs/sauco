<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $table = 'account_types';

    protected $fillable = [
        'denomination'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
