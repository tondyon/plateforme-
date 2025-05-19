<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantDashboardController extends Controller
{public function index()
    {
        $etudiant = auth()->user();
        $courses = $etudiant->courses;  // Récupère les cours auxquels l'étudiant est inscrit
        $progress = $courses->map(function ($course) {
            return [
                'course' => $course,
                'progress' => $course->progress($etudiant),  // Une méthode fictive pour suivre les progrès
            ];
        });
        $availableCourses = Course::whereNotIn('id', auth()->user()->courses->pluck('id'))->get();
        return view('etudiant.dashboard', compact('availableCourses'));
    }

}
