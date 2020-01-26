<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccountType extends Model
{
    protected $table = 'bank_account_types';

    protected $fillable = [
        'denomination'
    ];

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}
