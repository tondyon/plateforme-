<?php

namespace App\Notifications;

use App\Models\Badge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BadgeEarnedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $badge;

    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau Badge Obtenu !')
            ->line('Félicitations ! Vous avez obtenu un nouveau badge.')
            ->line('Badge : ' . $this->badge->name)
            ->line($this->badge->description)
            ->action('Voir mon badge', route('badges.show', $this->badge))
            ->line('Continuez comme ça !');
    }

    public function toArray($notifiable): array
    {
        return [
            'badge_id' => $this->badge->id,
            'badge_name' => $this->badge->name,
            'badge_description' => $this->badge->description,
            'badge_type' => $this->badge->type,
            'points_earned' => $this->badge->points_value,
        ];
    }
}