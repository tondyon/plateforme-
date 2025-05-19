<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseFileController extends Controller
{
    public function index()
    {
        $files = CourseFile::where('user_id', Auth::id())->latest()->get();
        return view('formateur.courses.files.index', compact('files'));
    }

    public function create()
    {
        return view('formateur.courses.files.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,txt',
        ]);
        $path = $request->file('file')->store('courses', 'public');
        $fileType = $request->file('file')->getClientOriginalExtension();
        $file = CourseFile::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'file_type' => $fileType,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('formateur.courses.files.index')->with('success', 'Fichier publié avec succès.');
    }

    public function show(CourseFile $file)
    {
        $this->authorize('view', $file);
        return view('formateur.courses.files.show', compact('file'));
    }

    public function destroy(CourseFile $file)
    {
        $this->authorize('delete', $file);
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
        return redirect()->route('formateur.courses.files.index')->with('success', 'Fichier supprimé.');
    }
}
