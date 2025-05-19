<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Course;
use Carbon\Carbon;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('layouts.navigation', function ($view) {
            if (auth()->check()) {
                $lastVisit = auth()->user()->last_visit_at ?? Carbon::now()->subDays(30);
                $newCoursesCount = Course::where('created_at', '>', $lastVisit)->count();
                $view->with('newCoursesCount', $newCoursesCount);
            }
        });
    }
}
