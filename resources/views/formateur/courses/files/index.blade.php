@extends('layouts.app')
@section('title', 'Mes fichiers de cours')
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Mes fichiers de cours</h2>
    <a href="{{ route('formateur.courses.files.create') }}" class="mb-4 inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-bold">Publier un nouveau fichier</a>
    <div class="bg-white rounded shadow p-6">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left p-2">Titre</th>
                    <th class="text-left p-2">Type</th>
                    <th class="text-left p-2">Publié le</th>
                    <th class="text-left p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($files as $file)
                    <tr>
                        <td class="p-2">{{ $file->title }}</td>
                        <td class="p-2">{{ strtoupper($file->file_type) }}</td>
                        <td class="p-2">{{ $file->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-2">
                            <a href="{{ route('formateur.courses.files.show', $file) }}" class="text-blue-600 hover:underline">Voir</a>
                            <form action="{{ route('formateur.courses.files.destroy', $file) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Aucun fichier publié.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
