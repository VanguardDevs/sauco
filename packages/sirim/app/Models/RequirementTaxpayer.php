<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementTaxpayer extends Model
{
    protected $table = 'requirement_taxpayer';

    protected $fillable = [
        'active',
        'taxpayer_id',
        'requirement_id',
        'liquidation_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
}
