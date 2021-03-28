<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\PrettyAmount;

class Settlement extends Model implements Auditable
{
    use PrettyAmount, SoftDeletes, Audit;

    protected $table = 'settlements';

    protected $guarded = [];

    protected $appends = ['pretty_amount'];

    protected $casts = [
        'amount' => 'float'
    ];

    public static function newNum()
    {
        $lastNum = self::withTrashed()
            ->orderBy('num','DESC')
            ->first()
            ->num;

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class, 'taxpayer_id');
    }

    public function withholding()
    {
        return $this->belongsTo(Withholding::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function fine()
    {
        return $this->belongsTo(Fine::class);
    }

    public function affidavit()
    {
        return $this->belongsTo(Affidavit::class, 'affidavit_id');
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
