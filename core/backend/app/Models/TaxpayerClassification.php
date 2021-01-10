<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxpayerClassification extends Model
{
    protected $table = 'taxpayer_classifications';

    public function taxpayers()
    {
        return $this->hasMany(Taxpayer::class);
    }
}
