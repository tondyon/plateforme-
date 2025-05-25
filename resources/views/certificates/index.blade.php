@extends('layouts.app')

@section('content')

<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6 text-blue-800">Tous les certificats / diplômes en ligne</h1>
    <div class="mb-4">
        <a href="{{ route('certificates.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Ajouter un certificat</a>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        @if($certificates->isEmpty())
            <p>Aucun certificat disponible pour le moment.</p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Titre</th>
                        <th class="py-2 px-4 border-b">Description</th>
                        <th class="py-2 px-4 border-b">Date d'émission</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certificates as $certificate)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $certificate->title }}</td>
                            <td class="py-2 px-4 border-b">{{ $certificate->description }}</td>
                            <td class="py-2 px-4 border-b">{{ $certificate->issued_at ? $certificate->issued_at->format('d/m/Y') : '-' }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('certificates.show', $certificate->id) }}" class="text-blue-600 underline">Voir</a>
                                @if($certificate->file_path)
                                    | <a href="{{ asset('storage/'.$certificate->file_path) }}" target="_blank" class="text-green-600 underline">Télécharger</a>
                                @endif
                                | <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 underline" onclick="return confirm('Supprimer ce certificat ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
