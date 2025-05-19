<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
     {
         $query = Log::with('user');

         if ($request->filled('date')) {
             $query->whereDate('created_at', $request->date);
         }

         if ($request->filled('superviseur')) {
             $query->whereHas('user', function ($q) use ($request) {
                 $q->where('name', 'like', '%' . $request->superviseur . '%');
             });
         }

         if ($request->filled('action')) {
             $query->where('action', 'like', '%' . $request->action . '%');
         }

         $logs = $query->latest()->paginate(20); // Pagination

         return view('logs.index', compact('logs'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
