<?php

namespace App\Listeners;

use App\Events\CourseCompleted;
use App\Notifications\CourseCompletionNotification;

class HandleCourseCompletion
{
    public function handle(CourseCompleted $event)
    {
        // Générer le code de vérification pour le certificat
        $event->course->generateCertificateCode($event->user->id);
        
        // Envoyer la notification
        $event->user->notify(new CourseCompletionNotification($event->course));
        
        // Ajouter des points d'expérience pour la complétion du cours
        $event->user->addExperience(500, "Cours terminé : {$event->course->title}");
    }
}