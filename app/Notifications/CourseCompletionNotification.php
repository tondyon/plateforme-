<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CourseCompletionNotification extends Notification
{
    use Queueable;

    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = route('courses.certificate', $this->course);

        return (new MailMessage)
            ->subject('Félicitations ! Vous avez terminé le cours')
            ->line('Félicitations ! Vous avez terminé avec succès le cours "' . $this->course->title . '".')
            ->line('Vous pouvez maintenant télécharger votre certificat de réussite.')
            ->action('Télécharger le certificat', $url)
            ->line('Merci de votre participation et bonne continuation dans votre apprentissage !');
    }

    public function toArray($notifiable)
    {
        return [
            'course_id' => $this->course->id,
            'course_title' => $this->course->title,
            'message' => 'Vous avez terminé le cours "' . $this->course->title . '". Téléchargez votre certificat !',
            'type' => 'course_completion'
        ];
    }
}
