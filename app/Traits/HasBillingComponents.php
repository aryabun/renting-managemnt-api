<?php

namespace App\Traits;

use App\Models\BillingComponent;

trait HasBillingComponents
{
    public function billingComponents()
    {
        return $this->morphMany(BillingComponent::class, 'billable');
    }

    public function activeComponents()
    {
        return $this->billingComponents()->whereNull('effective_to');
    }
}
