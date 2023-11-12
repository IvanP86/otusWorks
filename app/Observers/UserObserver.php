<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Log::info("Создан новый пользователь id = " . $user->id);
    }
    public function updating(User $user): void
    {
        Log::info("Старые значения " . User::find($user->id));
    }
    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Log::info("Изменен пользователь " . $user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::alert("Удален пользователь id = " . $user->id);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
