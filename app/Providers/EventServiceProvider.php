<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CourseCompleted;
use App\Events\QuizCompleted;
use App\Events\BadgeEarned;
use App\Events\CourseEnrollment;
use App\Listeners\HandleCourseEnrollment;
use App\Listeners\HandleCourseCompletion;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CourseCompleted::class => [
            'App\Listeners\CheckForNewBadges',
            HandleCourseCompletion::class,
        ],
        QuizCompleted::class => [
            'App\Listeners\CheckForNewBadges',
        ],
        BadgeEarned::class => [
            'App\Listeners\NotifyUserOfBadge',
        ],
        CourseEnrollment::class => [
            HandleCourseEnrollment::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Register badge-related events
        Event::listen('course.completed', function ($user, $course) {
            $user->checkForNewBadges();
        });

        Event::listen('quiz.completed', function ($user, $quiz, $score) {
            $user->checkForNewBadges();
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
