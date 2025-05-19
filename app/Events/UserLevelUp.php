<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLevelUp
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $oldLevel;
    public $newLevel;

    public function __construct(User $user, int $oldLevel, int $newLevel)
    {
        $this->user = $user;
        $this->oldLevel = $oldLevel;
        $this->newLevel = $newLevel;
    }
}
