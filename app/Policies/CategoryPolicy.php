<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function any(User $user): bool
    {
        return $user->role->title !== "User";
    }
}
