<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MakeLiquidation;
use App\Traits\PaymentUtils;
use App\Traits\NewValue;
use App\Traits\PrettyAmount;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withholding extends Model
{
    use MakeLiquidation, PaymentUtils, PrettyAmount, NewValue, SoftDeletes;

    protected $table = 'withholdings';

    protected $fillable = [
        'num',
        'amount',
        'taxpayer_id',
        'retainer_id',
        'withholder_id'
    ];

    public function taxpayer()
    {
        return $this->hasMany(Taxpayer::class);
    }

    public function retainer()
    {
        return $this->hasMany(Taxpayer::class);
    }
}
