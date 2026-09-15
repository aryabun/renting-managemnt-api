<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    //
    public function billingComponent()
    {
        return $this->belongsTo(BillingComponent::class);
    }
}
