<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Withholding extends Model implements Auditable 
{
    use SoftDeletes;
    use Audit;

    protected $table = 'withholdings';

    protected $fillable = [
        'user_id',
        'affidavit_id',
        'amount'
    ];

    public function affidavit()
    {
        return $this->belongsTo(Affidavit::class);
    }

    public function taxpayer()
    {
        return $this->hasOneThrough(Taxpayer::class, Affidavit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function settlement()
    {
        return $this->hasOne(Settlement::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class, Settlement::class);
    }
}
