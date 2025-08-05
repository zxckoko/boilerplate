<?php

namespace App\Observers;

use App\Models\Role;

class RoleObserver extends Observer
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        //
    }

    public function creating(Role $role): void
    {
        $role->created_by = auth()->user()?->id ?? 1;
        $role->updated_by = auth()->user()?->id ?? 1;
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        //
    }

    public function updating(Role $role): void
    {
        $role->updated_by = auth()->user()?->id ?? 1;
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {

    }

    public function deleting(Role $role): void
    {
        $this->setDeletedByValue($role);
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
    }

    public function restoring(Role $role): void
    {
        $role->deleted_by = null;
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
    }
}
