<?php

namespace App\Policies;

use App\Models\Element;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ElementPolicy
{
    public function any(User $user): bool
    {
        return $user->role->title !== "User";
    }

}
