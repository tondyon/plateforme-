<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class FormateurCourseController extends Controller
{
    // Affiche la liste des cours du formateur
    public function index()
    {
        $courses = Auth::user()->taughtCourses; // ou createdCourses selon votre modèle
        return view('formateur.courses', compact('courses'));
    }

    // Affiche le formulaire de création d'un cours
    public function create()
    {
        return view('formateur.create-course');
    }

    // Enregistre un nouveau cours
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->teacher_id = Auth::id(); // ou 'formateur_id' selon votre modèle
        $course->save();
        return redirect()->route('formateur.courses')->with('success', 'Cours créé avec succès.');
    }

    // Affiche le formulaire d'édition d'un cours
    public function edit(Course $course)
    {
        // Vérifie que le formateur est bien le propriétaire du cours
        if ($course->teacher_id !== Auth::id()) {
            abort(403);
        }
        return view('formateur.edit-course', compact('course'));
    }

    // Met à jour un cours existant
    public function update(Request $request, Course $course)
    {
        if ($course->teacher_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $course->title = $request->title;
        $course->description = $request->description;
        $course->save();
        return redirect()->route('formateur.courses')->with('success', 'Cours modifié avec succès.');
    }

    // Supprime un cours
    public function destroy(Course $course)
    {
        if ($course->teacher_id !== Auth::id()) {
            abort(403);
        }
        $course->delete();
        return redirect()->route('formateur.courses')->with('success', 'Cours supprimé avec succès.');
    }
}
