@extends('layouts.app')
@section('title', $file->title)
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">{{ $file->title }}</h2>
    <p class="mb-2 text-gray-700">{{ $file->description }}</p>
    <div class="mb-4">
        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-bold">Télécharger / Voir le fichier</a>
    </div>
    <div class="text-gray-500 text-sm">
        Type : {{ strtoupper($file->file_type) }}<br>
        Publié le : {{ $file->created_at->format('d/m/Y H:i') }}
    </div>
</div>
@endsection
