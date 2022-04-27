<?php

namespace App\Traits;

trait PrettyTimestamps
{
    public function getDownloadedAtAttribute($value)
    {
        return Date('d/m/Y h:i', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return Date('d/m/Y h:i', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y h:i', strtotime($value));
    }

    public function getProcessedAtAttribute($value)
    {
        return Date('d/m/Y h:i A', strtotime($value));
    }

    public function getDeletedAtAttribute($value)
    {
        return Date('d/m/Y h:i', strtotime($value));
    }

    public function pretty($columnName, $format = 'd/m/Y h:i')
    {
        $column = $this[$columnName];

        return Date($format, strtotime($column));
    }
}
