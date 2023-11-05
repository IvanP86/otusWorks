<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function anyManagerAndAdmin(User $user): bool
    {
        return $user->role->title !== "User";
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return ($user->role->title === "Admin" || ($user->role->title === "Manager" && $model->role->title === "User"));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->role->title !== "User";
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->role->title !== "User";
    }
}
