<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckForNewBadges implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle($event): void
    {
        if (property_exists($event, 'user')) {
            $user = $event->user;
            $user->checkForNewBadges();
        }
    }
}