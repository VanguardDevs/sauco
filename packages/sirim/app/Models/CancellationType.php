<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationType extends Model
{
    use HasFactory;

    protected $table = 'cancellation_types';

    protected $fillable = [
        'name'
    ];

    public function cancellations()
    {
        return $this->hasMany(Cancellation::class);
    }
}
