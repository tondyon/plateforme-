@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-blue-800">Détail du certificat</h1>
    <div class="bg-white shadow rounded-lg p-6">
        <p><strong>Titre :</strong> {{ $certificate->title }}</p>
        <p><strong>Description :</strong> {{ $certificate->description }}</p>
        <p><strong>Date d'émission :</strong> {{ $certificate->issued_at ? $certificate->issued_at->format('d/m/Y') : '-' }}</p>
        @if($certificate->file_path)
            <p><strong>Fichier :</strong> <a href="{{ asset('storage/'.$certificate->file_path) }}" target="_blank" class="text-green-600 underline">Télécharger</a></p>
        @endif
    </div>
    <div class="mt-6">
        <a href="{{ route('certificates.edit', $certificate->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded mr-2">Modifier</a>
        <a href="{{ route('certificates.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Retour à la liste</a>
    </div>
</div>
@endsection
