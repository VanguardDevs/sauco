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

    public function getTotalAmountAttribute($value)
    {
        return number_format($this->amount, 2, ',', '.');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function withholding()
    {
        return $this->belongsTo(Withholding::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class);
    }

    public function fine()
    {
        return $this->belongsTo(Fine::class);
    }

    public function affidavit()
    {
        return $this->belongsTo(Affidavit::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
