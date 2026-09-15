<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingComponent extends Model
{
    //
    public function meterReadings()
    {
        return $this->hasMany(MeterReading::class);
    }

    public function latestReading()
    {
        return $this->hasOne(MeterReading::class)->latestOfMany('reading_date');
    }
}
