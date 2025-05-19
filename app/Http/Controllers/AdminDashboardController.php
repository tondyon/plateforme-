<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class AdminDashboardController extends Controller
{
    // AdminDashboardController.php
    public function index()
    {
        $courses = Course::all();
        $totalUsers      = User::count();
        $totalCourses    = Course::count();
        $totalFormateurs = User::where('role', 'formateur')->count();
        $totalEtudiants = User::where('role', 'etudiant')->count();

        $totalVisits = Visitor::count();
        $mostVisitedPages = Visitor::select('page_visited', \DB::raw('count(*) as count'))
            ->groupBy('page_visited')
            ->orderByDesc('count')
            ->take(5)
            ->pluck('count', 'page_visited');
        $recentVisits = Visitor::orderByDesc('visited_at')->take(5)->get();

        return view('admin.dashboard', compact('courses', 'totalUsers', 'totalCourses', 'totalFormateurs', 'totalEtudiants', 'totalVisits', 'mostVisitedPages', 'recentVisits'));
    }

}

