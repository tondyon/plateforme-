<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;

class BadgeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Listen to login events properly
        Event::listen(Login::class, function (Login $event) {
            $event->user->checkForNewBadges();
        });

        // Vérifier les badges quand un cours est complété
        Course::updated(function ($course) {
            $progress = $course->progress()->where('completion_percentage', 100)->get();
            foreach ($progress as $p) {
                $p->user->checkForNewBadges();
            }
        });

        // Vérifier les badges après un quiz
        Quiz::created(function ($quiz) {
            if ($quiz->hasUserPassed($quiz->user)) {
                $quiz->user->checkForNewBadges();
            }
        });
    }
}
