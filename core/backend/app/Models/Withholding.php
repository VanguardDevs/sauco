<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;

class Withholding extends Model implements Auditable 
{
    use SoftDeletes, Audit, PrettyAmount, PrettyTimestamps;

    protected $table = 'withholdings';

    protected $fillable = [
        'user_id',
        'liquidation_id',
        'amount'
    ];

    protected $appends = [ 'pretty_amount' ];

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }

    public function company()
    {
        return $this->liquidation()->company()->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function NullWithholding()
    {
      return $this->hasOne(NullWithholding::class);
    }
}
