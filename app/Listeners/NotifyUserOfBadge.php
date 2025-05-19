<?php

namespace App\Listeners;

use App\Events\BadgeEarned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BadgeEarnedNotification;

class NotifyUserOfBadge implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BadgeEarned $event): void
    {
        $event->user->notify(new BadgeEarnedNotification($event->badge));
    }
}