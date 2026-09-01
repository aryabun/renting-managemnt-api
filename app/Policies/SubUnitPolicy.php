<?php
namespace App\Policies;

use App\Models\Property;
use App\Models\SubUnit;
use App\Models\User;

class SubUnitPolicy
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
    public function view(User $user, SubUnit $subUnit): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Property $property): bool
    {
         // ONLY owner or super admin — management team cannot create units
        return $user->isSuperAdmin() || $property->isOwnedBy($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubUnit $subUnit): bool
    {
        // owner AND management team can update
        return $user->isSuperAdmin()
            || $subUnit->property->isOwnedBy($user)
            || $subUnit->property->hasMember($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubUnit $subUnit): bool
    {
        // ONLY owner or super admin — same restriction as create
        return $user->isSuperAdmin() || $subUnit->property->isOwnedBy($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubUnit $subUnit): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubUnit $subUnit): bool
    {
        return false;
    }
}
