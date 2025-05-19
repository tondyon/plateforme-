@extends('layouts.app')
@section('title', 'Publier un cours')
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Publier un cours (PDF, Word, etc.)</h2>
    <form method="POST" action="{{ route('formateur.courses.files.store') }}" enctype="multipart/form-data" class="bg-white rounded shadow p-6 max-w-lg mx-auto">
        @csrf
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-2">Titre du fichier</label>
            <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-2">Description</label>
            <textarea id="description" name="description" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
        </div>
        <div class="mb-4">
            <label for="file" class="block font-semibold mb-2">Fichier (PDF, Word, TXT)</label>
            <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.txt" class="w-full" required>
        </div>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-bold">Publier</button>
    </form>
</div>
@endsection
