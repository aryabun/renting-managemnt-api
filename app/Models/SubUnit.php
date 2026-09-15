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
        'status_id',
        'tenant_id',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
