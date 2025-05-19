@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Créer un cours</h1>
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Titre</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('title')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" rows="5" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('description') }}</textarea>
            @error('description')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700">Prix (€)</label>
            <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', 0) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('price')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image (optionnelle)</label>
            <input type="file" name="image" id="image" class="w-full">
            @error('image')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Enregistrer</button>
    </form>
</div>
@endsection
