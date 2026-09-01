<?php
namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Property $property): bool
    {
         return $user->isSuperAdmin()
        || $property->isOwnedBy($user)
        || $property->hasMember($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Property $property): bool
    {
        return $user->isSuperAdmin()
        || $property->isOwnedBy($user)
        || $property->hasMember($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Property $property): bool
    {
        // owner or management team can update building info (e.g. address)
        return $user->isSuperAdmin()
        || $property->isOwnedBy($user)
        || $property->hasMember($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Property $property): bool
    {
        // only owner or super admin can delete the whole building
        return $user->isSuperAdmin() || $property->isOwnedBy($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Property $property): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Property $property): bool
    {
        return false;
    }
    public function invite(User $user, Property $property): bool
    {
        // only the creator/owner (or super admin) can invite management team
        return $user->isSuperAdmin() || $property->isOwnedBy($user);
    }
}
