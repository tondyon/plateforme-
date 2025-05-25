@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-blue-800">Ajouter un certificat</h1>
    <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-2">Titre *</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" required value="{{ old('title') }}">
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-2">Description</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="file_path" class="block font-semibold mb-2">Fichier (PDF/Image)</label>
            <input type="file" name="file_path" id="file_path" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label for="issued_at" class="block font-semibold mb-2">Date d'émission</label>
            <input type="date" name="issued_at" id="issued_at" class="w-full border rounded px-3 py-2" value="{{ old('issued_at') }}">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Créer</button>
    </form>
</div>
@endsection
