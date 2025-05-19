<?php

namespace App\Events;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BadgeEarned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $badge;

    public function __construct(User $user, Badge $badge)
    {
        $this->user  = $user;
        $this->badge = $badge;
    }
}
