@extends('layouts.app')
@section('title', 'Modifier la réunion')
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Modifier la réunion</h2>
    <form method="POST" action="{{ route('formateur.meetings.update', $meeting) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-2">Titre</label>
            <input type="text" id="title" name="title" value="{{ old('title', $meeting->title) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-2">Description</label>
            <textarea id="description" name="description" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $meeting->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="scheduled_at" class="block font-semibold mb-2">Date et heure</label>
            <input type="datetime-local" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at', $meeting->scheduled_at ? $meeting->scheduled_at->format('Y-m-d\TH:i') : '' ) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="zoom_link" class="block font-semibold mb-2">Lien Zoom (optionnel)</label>
            <input type="url" id="zoom_link" name="zoom_link" value="{{ old('zoom_link', $meeting->zoom_link) }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-bold">Enregistrer</button>
    </form>
</div>
@endsection
