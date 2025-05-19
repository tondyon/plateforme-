<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        // Récupération des cours suivis par l'utilisateur (étudiant)
        $courses = $user->courses()->orderBy('start_date', 'asc')->get();

        // Prochain cours à venir
        $nextCourse = $courses->where('start_date', '>=', now())->sortBy('start_date')->first();

        // Progrès moyen (suppose qu'il y a un champ 'progress' sur la relation pivot)
        $averageProgress = $courses->count() > 0 ? round($courses->avg('pivot.progress'), 1) : 0;

        return view('home', [
            'courses' => $courses,
            'nextCourse' => $nextCourse,
            'averageProgress' => $averageProgress
        ]);
    }
}
