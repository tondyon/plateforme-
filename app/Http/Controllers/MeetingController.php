<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
          /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = \App\Models\Meeting::where('formateur_id', Auth::id())->orderBy('scheduled_at', 'desc')->get();
        return view('formateur.meetings.index', compact('meetings'));
    }

          /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formateur.meetings.create');
    }

          /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'scheduled_at' => 'required|date',
            'zoom_link'    => 'nullable|url',
        ]);
        Meeting::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'scheduled_at' => $request->scheduled_at,
            'formateur_id' => Auth::id(),
            'zoom_link'    => $request->zoom_link,
        ]);
        return redirect()->route('formateur.dashboard')->with('success', 'Réunion créée avec succès.');
    }

          /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meeting = \App\Models\Meeting::where('formateur_id', Auth::id())->findOrFail($id);
        return view('formateur.meetings.show', compact('meeting'));
    }

          /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meeting = \App\Models\Meeting::where('formateur_id', Auth::id())->findOrFail($id);
        return view('formateur.meetings.edit', compact('meeting'));
    }

          /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $meeting = \App\Models\Meeting::where('formateur_id', Auth::id())->findOrFail($id);
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'scheduled_at' => 'required|date',
            'zoom_link'    => 'nullable|url',
        ]);
        $meeting->update($request->only(['title', 'description', 'scheduled_at', 'zoom_link']));
        return redirect()->route('formateur.meetings.index')->with('success', 'Réunion modifiée avec succès.');
    }

          /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meeting = \App\Models\Meeting::where('formateur_id', Auth::id())->findOrFail($id);
        $meeting->delete();
        return redirect()->route('formateur.meetings.index')->with('success', 'Réunion supprimée avec succès.');
    }
}
