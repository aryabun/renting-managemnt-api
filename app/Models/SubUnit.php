<?php

namespace App\Models;

use App\Traits\HasBillingComponents;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SubUnit extends Model
{
    use HasUuids, HasBillingComponents;
     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'property_id',
        'price',
        'is_manual_bill',
        'status_id',
        'tenant_id',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function billingComponents()
    {
        return $this->morphMany(BillingComponent::class, 'billable');
    }
}
