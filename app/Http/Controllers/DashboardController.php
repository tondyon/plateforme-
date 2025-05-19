<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Récupérer les notifications non lues
        $notifications = $user->unreadNotifications()->take(5)->get();
        $notificationsCount = $user->unreadNotifications()->count();

        // Récupérer les derniers badges
        $recentBadges = $user->badges()->latest()->take(3)->get();

        // Récupérer les cours en cours
        $currentCourses = $user->enrolledCourses()
            ->wherePivot('completed_at', null)
            ->latest()
            ->take(3)
            ->get();
        $coursesCount = $user->enrolledCourses()->count();

        // Récupérer le nombre de réunions (si relation meetings existe)
        $meetingsCount = method_exists($user, 'meetings') ? $user->meetings()->count() : 0;

        // Récupérer les statistiques
        $stats = [
            'level' => $user->level ?? 0,
            'experience' => $user->experience_points ?? 0,
            'badges_count' => $user->badges()->count(),
            'completed_courses' => $user->enrolledCourses()->wherePivot('progress', 100)->count()
        ];

        // Récupérer les cours recommandés (pour l'instant aléatoirement)
        $recommendedCourses = Course::whereNotIn('id', $user->enrolledCourses()->pluck('course_id'))
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Actualités dynamiques
        $news = \App\Models\News::latest()->take(5)->get();

        // Préparation des données pour le graphique (exemple simple)
        $enCours = $user->enrolledCourses()->wherePivot('progress', '<', 100)->count();
        $termines = $user->enrolledCourses()->wherePivot('progress', 100)->count();
        $nonCommences = \App\Models\Course::count() - $enCours - $termines;
        $chartData = [
            'enCours' => $enCours,
            'termines' => $termines,
            'nonCommences' => $nonCommences
        ];

        return view('dashboard', compact(
            'notifications',
            'notificationsCount',
            'recentBadges',
            'currentCourses',
            'coursesCount',
            'meetingsCount',
            'stats',
            'recommendedCourses',
            'news',
            'chartData'
        ));
    }
}

