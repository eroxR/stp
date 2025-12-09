<?php

namespace App\Policies;

use App\Models\EconomicActivityCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EconomicActivityCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EconomicActivityCategory $economicActivityCategory): bool
    {
        return false;
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
    public function update(User $user, EconomicActivityCategory $economicActivityCategory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EconomicActivityCategory $economicActivityCategory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EconomicActivityCategory $economicActivityCategory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EconomicActivityCategory $economicActivityCategory): bool
    {
        return false;
    }
}
