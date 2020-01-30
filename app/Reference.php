<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';

    protected $fillable = [
        'reference',
        'bank_account_id',
        'payment_id'
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
