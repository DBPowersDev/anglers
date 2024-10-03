<?php

namespace App\Policies;

use App\Models\Fishing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FishingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Fishing $fishing): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fishing $fishing): bool
    {
        return $user->id === $fishing->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fishing $fishing): bool
    {
        return $user->id === $fishing->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Fishing $fishing): bool
    {
        return $user->id === $fishing->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Fishing $fishing): bool
    {
        return $user->id === $fishing->user_id;
    }
}
