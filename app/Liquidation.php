<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\NewValue;

class Liquidation extends Model implements Auditable
{
    use SoftDeletes, Audit, NewValue;

    protected $table = 'liquidations';

    protected $guarded = [];
 
    protected $casts = ['amount' => 'float' ];  

    protected $appends = [
        'formatted_amount'
    ];

    public function getFormattedAmountAttribute($value)
    {
        return number_format($this->amount, 2, ',', '.');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function liquidationType()
    {
        return $this->belongsTo(LiquidationType::class);
    }

    public function canceledLiquidation()
    {
        return $this->hasOne(CanceledLiquidation::class);
    }

    public function fine()
    {
        return $this->belongsTo(Fine::class, 'model_id');
    }

    public function affidavit()
    {
        return $this->belongsTo(Affidavit::class, 'model_id');
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'model_id');
    }
}
