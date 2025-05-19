<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFeedbackNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouveau feedback reçu')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Vous avez reçu un nouveau feedback sur le cours : ' . $this->feedback->course->title)
            ->line('Note : ' . $this->feedback->note . '/5')
            ->line('Commentaire : ' . $this->feedback->content)
            ->action('Voir le dashboard', url('/formateur/dashboard'));
    }

    public function toArray($notifiable)
    {
        return [
            'feedback_id' => $this->feedback->id,
            'course_id' => $this->feedback->course_id,
            'course_title' => $this->feedback->course->title,
            'note' => $this->feedback->note,
            'content' => $this->feedback->content,
            'is_anonymous' => $this->feedback->is_anonymous,
            'created_at' => $this->feedback->created_at,
        ];
    }
}
