<?php

namespace App\Listeners;

use App\Events\CourseEnrollment;

class HandleCourseEnrollment
{
    public function handle(CourseEnrollment $event)
    {
        // Ajouter des points d'expérience pour l'inscription
        $event->user->addExperience(100, "Inscription au cours : {$event->course->title}");

        // Vérifier si c'est le premier cours de l'utilisateur
        if ($event->user->enrolledCourses()->count() === 1) {
            // Points bonus pour le premier cours
            $event->user->addExperience(200, "Premier cours commencé !");
        }

        // Vérifier les badges potentiels
        $event->user->checkForNewBadges();
    }
}
