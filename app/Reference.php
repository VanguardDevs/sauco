<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'references';

    protected $fillable = [
        'reference',
        'account_id',
        'payment_id'
    ];

    public function account()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
