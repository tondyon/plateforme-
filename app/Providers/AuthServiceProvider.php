<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Course;
use App\Models\CertificateVerification;
use App\Policies\CertificateVerificationPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Course::class => \App\Policies\CoursePolicy::class,
        CertificateVerification::class => CertificateVerificationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate pour les administrateurs
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';  // Adaptez selon votre structure
        });

        // Gate pour l'accès admin (alternative)
        Gate::define('access-admin', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate pour les gestionnaires de contenu
        Gate::define('manage-content', function (User $user) {
            return in_array($user->role, ['admin', 'formateur']);
        });

        // Gate pour la modification des cours
        Gate::define('update-course', function (User $user, Course $course) {
            return $user->id === $course->user_id || $user->role === 'admin';
        });

        // Gate pour la suppression des cours
        Gate::define('delete-course', function (User $user, Course $course) {
            return $user->id === $course->user_id || $user->role === 'admin';
        });

        // Gate pour les formateurs
        Gate::define('formateur', function (User $user) {
            return $user->role === 'formateur';
        });

        // Bypass for admins and super_admin
        Gate::before(function (User $user, $ability) {
            if ($user->is_admin || $user->role === 'super_admin') {
                return true;
            }
        });

        // Gate pour la visualisation des badges
        Gate::define('view-badges', function ($user) {
            return true; // Everyone can view badges
        });

        // Gate pour la gestion des badges
        Gate::define('manage-badges', function ($user) {
            return $user->isAdmin(); // Only admins can manage badges
        });
    }
}
