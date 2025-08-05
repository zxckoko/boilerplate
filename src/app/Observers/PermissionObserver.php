<?php

namespace App\Observers;

use App\Models\Permission;

class PermissionObserver extends Observer
{
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        //
    }

    public function creating(Permission $permission): void
    {
        $permission->created_by = auth()->user()?->id ?? 1;
        $permission->updated_by = auth()->user()?->id ?? 1;
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        //
    }

    public function updating(Permission $permission): void
    {
        $permission->updated_by = auth()->user()?->id ?? 1;
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {

    }

    public function deleting(Permission $permission): void
    {
        $this->setDeletedByValue($permission);
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $permission): void
    {
        //
    }

    public function restoring(Permission $permission): void
    {
        $permission->deleted_by = null;
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {
        //
    }
}
