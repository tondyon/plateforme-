<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExperienceGainedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $points;
    protected $reason;

    public function __construct(int $points, string $reason)
    {
        $this->points = $points;
        $this->reason = $reason;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'points' => $this->points,
            'reason' => $this->reason,
            'type' => 'experience_gained',
        ];
    }
}
