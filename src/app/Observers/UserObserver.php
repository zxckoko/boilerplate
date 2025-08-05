<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class UserObserver extends Observer implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    public function creating(User $user): void
    {
        $user->created_by = auth()->user()?->id ?? 1;
        $user->updated_by = auth()->user()?->id ?? 1;
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    public function updating(User $user): void
    {
        $user->updated_by = auth()->user()?->id ?? 1;
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {

    }

    public function deleting(User $user): void
    {
        $this->setDeletedByValue($user);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    public function restoring(User $user): void
    {
        $user->deleted_by = null;
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
