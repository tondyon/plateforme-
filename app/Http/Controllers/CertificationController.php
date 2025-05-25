<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificationController extends Controller
{
    /**
     * Affiche la liste des certifications.
     */
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificates.index', compact('certificates'));
    }

    /**
     * Affiche le formulaire de création d'un certificat.
     */
    public function create()
    {
        return view('certificates.create');
    }

    /**
     * Enregistre un nouveau certificat.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file',
            'issued_at' => 'nullable|date',
        ]);

        // Gestion du fichier uploadé
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('certificates', 'public');
        }

        Certificate::create($validated);
        return redirect()->route('certificates.index')->with('success', 'Certificat créé avec succès.');
    }

    /**
     * Affiche le détail d'un certificat.
     */
    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('certificates.show', compact('certificate'));
    }

    /**
     * Affiche le formulaire d'édition d'un certificat.
     */
    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('certificates.edit', compact('certificate'));
    }

    /**
     * Met à jour un certificat.
     */
    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file',
            'issued_at' => 'nullable|date',
        ]);
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('certificates', 'public');
        }
        $certificate->update($validated);
        return redirect()->route('certificates.index')->with('success', 'Certificat mis à jour avec succès.');
    }

    /**
     * Supprime un certificat.
     */
    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        return redirect()->route('certificates.index')->with('success', 'Certificat supprimé avec succès.');
    }
}
