<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Lab404\Impersonate\Events\LeaveImpersonation;

class LeaveImpersonationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LeaveImpersonation $event): void
    {
        $impersonator = $event->impersonator;
        $impersonated = $event->impersonated;
        $description = sprintf(
            '%s:%d stopped impersonating %s:%d',
            class_basename($impersonator),
            $impersonator->id,
            class_basename($impersonated),
            $impersonated->id,
        );

        activity()
            ->causedBy($impersonator)
            ->performedOn($impersonated)
            ->event('LeaveImpersonation')
            ->log("\"{$description}\"");
    }
}
