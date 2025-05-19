@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg py-8">
    <h2 class="text-2xl font-bold mb-6">Créer une réunion</h2>
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('formateur.meetings.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block font-medium">Titre *</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" value="{{ old('title') }}" required>
        </div>
        <div>
            <label for="description" class="block font-medium">Description</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="scheduled_at" class="block font-medium">Date et heure *</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="w-full border rounded px-3 py-2" value="{{ old('scheduled_at') }}" required>
        </div>
        <div>
            <label for="zoom_link" class="block font-medium">Lien Zoom (optionnel)</label>
            <input type="url" name="zoom_link" id="zoom_link" class="w-full border rounded px-3 py-2" value="{{ old('zoom_link') }}">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Créer</button>
        </div>
    </form>
</div>
@endsection
