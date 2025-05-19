<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseEnrollmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Inscription confirmée : ' . $this->course->title)
            ->greeting('Bonjour ' . $notifiable->name . ' !')
            ->line('Votre inscription au cours "' . $this->course->title . '" a été confirmée.')
            ->line('Vous pouvez dès maintenant commencer à suivre ce cours.')
            ->action('Accéder au cours', route('courses.show', $this->course))
            ->line('Bonne formation !');
    }

    public function toArray($notifiable): array
    {
        return [
            'message' => 'Vous êtes inscrit au cours : ' . $this->course->title,
            'course_id' => $this->course->id,
            'course_title' => $this->course->title,
            'link' => route('courses.show', $this->course),
            'type' => 'course_enrollment'
        ];
    }
}
