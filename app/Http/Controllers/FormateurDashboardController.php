<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class FormateurDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Récupérer les cours créés par le formateur
        $courses = Course::where('teacher_id', $user->id)->with(['students', 'lessons', 'payments', 'feedbacks'])->get();
        // Statistiques dynamiques
        $createdCourses = $courses->count();
        $studentsCount = $courses->reduce(function($carry, $course) {
            return $carry + $course->students->count();
        }, 0);
        // Taux de complétion moyen (si la table pivot a un champ 'progress' de 0 à 100)
        $completionRates = [];
        foreach ($courses as $course) {
            foreach ($course->students as $student) {
                if (isset($student->pivot->progress)) {
                    $completionRates[] = $student->pivot->progress;
                }
            }
        }
        $avgCompletion = count($completionRates) ? round(array_sum($completionRates) / count($completionRates), 1) : null;
        // Revenus réels à partir des paiements
        $revenus = $courses->reduce(function($carry, $course) {
            return $carry + $course->payments->where('status', 'paid')->sum('amount');
        }, 0);
        // Revenus par cours
        $revenusParCours = [];
        foreach ($courses as $course) {
            $revenusParCours[$course->id] = $course->payments->where('status', 'paid')->sum('amount');
        }
        // Notifications récentes
        $notifications = $user->unreadNotifications()->take(5)->get();
        return view('formateur-dashboard', compact('courses', 'createdCourses', 'studentsCount', 'avgCompletion', 'revenus', 'revenusParCours', 'notifications'));

    }
}
