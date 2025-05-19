<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectController extends Controller
{
    /**
     * Affiche le formulaire de création d'un direct.
     */
    public function create()
    {
        return view('formateur.directs.create');
    }

    /**
     * Enregistre un nouveau direct et redirige vers la page du direct.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        // Génération d'une URL de salle vidéo (exemple Jitsi Meet)
        $room = 'direct-' . uniqid();
        $video_url = 'https://meet.jit.si/' . $room;

        $direct = \App\Models\Direct::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'video_url' => $video_url,
        ]);

        return redirect()->route('formateur.direct.show', $direct);
    }

    /**
     * Affiche un direct créé
     */
    public function show(\App\Models\Direct $direct)
    {
        return view('formateur.directs.show', compact('direct'));
    
    }
}
