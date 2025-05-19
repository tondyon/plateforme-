<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $materials = $course->materials;
        return view('formateur.materials.index', compact('course', 'materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('formateur.materials.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:51200|mimes:pdf,doc,docx,ppt,pptx,mp4,avi,mov',
        ]);
        $path = $request->file('file')->store('course_materials', 'public');
        $course->materials()->create([
            'file_path' => $path,
            'file_type' => $request->file('file')->extension(),
        ]);
        return redirect()->route('courses.materials.index', $course)->with('success', 'Fichier ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, CourseMaterial $courseMaterial)
    {
        return view('formateur.materials.show', compact('course', 'courseMaterial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, CourseMaterial $courseMaterial)
    {
        return view('formateur.materials.edit', compact('course', 'courseMaterial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course, CourseMaterial $courseMaterial)
    {
        $validated = $request->validate([
            'file' => 'nullable|file|max:51200|mimes:pdf,doc,docx,ppt,pptx,mp4,avi,mov',
        ]);
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($courseMaterial->file_path);
            $path = $request->file('file')->store('course_materials', 'public');
            $courseMaterial->update([
                'file_path' => $path,
                'file_type' => $request->file('file')->extension(),
            ]);
        }
        return redirect()->route('courses.materials.index', $course)->with('success', 'Fichier mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, CourseMaterial $courseMaterial)
    {
        Storage::disk('public')->delete($courseMaterial->file_path);
        $courseMaterial->delete();
        return redirect()->route('courses.materials.index', $course)->with('success', 'Fichier supprimé.');
    }
}
