@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Modifier le cours</h1>
    <form method="POST" action="{{ route('formateur.courses.update', $course) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block font-semibold">Titre du cours</label>
            <input type="text" name="title" id="title" class="border rounded w-full p-2" value="{{ old('title', $course->title) }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" class="border rounded w-full p-2">{{ old('description', $course->description) }}</textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
