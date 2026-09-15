<?php
namespace App\Models;

use App\Traits\HasBillingComponents;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasUuids, HasBillingComponents;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'address',
        'price',
        'property_type_id',
        'unit_type_id',
        'status_id',
        'tenant_id',
        'owner_id',
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'teams')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function units()
    {
        return $this->hasMany(SubUnit::class);
    }
    public function isOwnedBy(User $user): bool
    {
        return $this->owner_id === $user->id;
    }
    public function hasMember(User $user): bool
    {
        return $this->members()->where('user_id', $user->id)->exists();
    }
    public function billingComponents()
    {
        return $this->morphMany(BillingComponent::class, 'billable');
    }
}
