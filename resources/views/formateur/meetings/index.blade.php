@extends('layouts.app')
@section('title','Mes Réunions')
@section('content')
<div class="container mx-auto py-8 min-h-screen flex">
    <aside class="w-64 bg-white shadow p-4 h-full">
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('formateur.meetings.create') }}" class="flex items-center text-gray-700 hover:bg-gray-100 px-3 py-2 rounded">
                        <i class="fas fa-plus mr-2"></i> Nouvelle Réunion
                    </a>
                </li>
                <li>
                    <a href="{{ route('formateur.direct') }}" class="flex items-center text-gray-700 hover:bg-gray-100 px-3 py-2 rounded">
                        <i class="fas fa-broadcast-tower mr-2"></i> Direct
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="flex-1 ml-6">
        <h2 class="text-2xl font-bold mb-4">Mes Réunions</h2>
        @if($meetings->isEmpty())
            <div class="text-center p-8">
                <p class="mb-4 text-lg">Aucune réunion programmée pour l'instant.</p>
                <a href="{{ route('formateur.meetings.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Créer une réunion</a>
                <a href="{{ route('formateur.direct') }}" class="inline-block ml-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Lancer un direct</a>
            </div>
        @else
            <ul class="space-y-4">
                @foreach($meetings as $meeting)
                    <li class="border rounded p-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold">{{ $meeting->title }}</h3>
                            <p class="text-gray-600">
    @if($meeting->scheduled_at instanceof \Illuminate\Support\Carbon)
        {{ $meeting->scheduled_at->format('d/m/Y H:i') }}
    @else
        {{ \Carbon\Carbon::parse($meeting->scheduled_at)->format('d/m/Y H:i') }}
    @endif
</p>
                        </div>
                        <a href="{{ route('formateur.meetings.show', $meeting) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            <i class="fas fa-video"></i> Lancer
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>
</div>  {{-- .flex wrapper --}}
@endsection
