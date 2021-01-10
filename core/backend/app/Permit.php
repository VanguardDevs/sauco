<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\PrettyTimestamps;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;

class Permit extends Model implements Auditable
{
    use SoftDeletes, PrettyAmount, Audit, PrettyTimestamps;

    protected $table = 'permits';

    protected $casts = [ 'amount' => 'float' ];

    protected $appends = [ 'pretty_amount' ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function liquidation()
    {
        return $this->hasOne(Liquidation::class);
    }
}
