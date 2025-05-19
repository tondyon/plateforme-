<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\SupervisorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function exportCourses(Request $request)
    {
        if (!Auth::user()->hasPermission('export_data')) {
            abort(403);
        }

        SupervisorLogger::log('course_export', ['count' => Course::count()], $request);

        $courses = Course::all();
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=courses_export.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($courses) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Titre', 'Description']);

            foreach ($courses as $course) {
                fputcsv($file, [
                    $course->id,
                    $course->titre,
                    $course->description
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
