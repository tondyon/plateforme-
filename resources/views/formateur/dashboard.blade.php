@extends('layouts.app')

@section('content')
<div class = "container mx-auto px-4 py-8">
<h1  class = "text-3xl font-bold mb-6">Tableau de bord Formateur</h1>
<div class="flex flex-wrap gap-4 mb-8">
    <a href="{{ route('formateur.direct.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded shadow flex items-center gap-2">
        <i class="fa fa-video"></i> Créer un direct
    </a>
    <a href="{{ route('formateur.meetings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded shadow flex items-center gap-2">
        <i class="fa fa-calendar-plus"></i> Créer une réunion
    </a>
    <a href="{{ route('formateur.direct') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded shadow flex items-center gap-2">
        <i class="fa fa-broadcast-tower"></i> Direct
    </a>
    <a href="{{ route('formateur.meetings.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded shadow flex items-center gap-2">
        <i class="fa fa-calendar"></i> Mes réunions
    </a>
    <a href="{{ route('formateur.direct') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded shadow flex items-center gap-2">
        <i class="fa fa-broadcast-tower"></i> Mes directs
    </a>
</div>
<!-- FontAwesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Section Mes cours --}}
    <div    class          = "mb-8 bg-white shadow-md rounded-lg p-6">
    <div    class          = "flex items-center justify-between mb-4">
    <h2     class          = "text-xl font-semibold">Mes cours</h2>
    <div    class          = "flex gap-4">
    <div    class          = "relative">
    <button id             = "dropdownButton" type              = "button" class                = "inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md focus:outline-none">
    <svg    xmlns          = "http://www.w3.org/2000/svg" class = "h-5 w-5 animate-bounce" fill = "none" viewBox = "0 0 24 24" stroke = "currentColor">
    <path   stroke-linecap = "round" stroke-linejoin            = "round" stroke-width          = "2" d          = "M12 4v16m8-8H4" />
                        </svg>
                        Nouveau
                        <svg  class          = "w-4 h-4 ml-1" fill     = "none" stroke        = "currentColor" viewBox = "0 0 24 24">
                        <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2" d                  = "M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id   = "dropdownMenu" class                            = "hidden absolute z-10 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg">
                    <a   href = "{{ route('formateur.courses.create') }}" class = "block px-4 py-2 text-gray-700 hover:bg-gray-100">Créer un nouveau cours</a>
                    </div>
                </div>

                <a    href           = "{{ route('formateur.courses.index') }}" class = "inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition">
                <svg  xmlns          = "http://www.w3.org/2000/svg" class       = "h-5 w-5 animate-spin" fill = "none" viewBox = "0 0 24 24" stroke = "currentColor">
                <path stroke-linecap = "round" stroke-linejoin                  = "round" stroke-width        = "2" d          = "M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7" />
                <path stroke-linecap = "round" stroke-linejoin                  = "round" stroke-width        = "2" d          = "M16 3v4M8 3v4M4 11h16" />
                    </svg>
                    Gérer mes cours
                </a>
            </div>
        </div>

        <ul class = "list-disc list-inside text-gray-700">
            @forelse($courses as $course)
                <li>{{ $course->title }}</li>
            @empty
                <li>Vous n'avez pas encore créé de cours.</li>
            @endforelse
        </ul>
    </div>

    {{-- Statistiques --}}
    <div class = "mb-8 bg-white shadow-md rounded-lg p-6">
    <h2  class = "text-xl font-semibold mb-4">Statistiques</h2>
    <ul  class = "text-gray-700">
            <li><strong>Cours     créés   : </strong> {{ $stats['created_courses'] ?? 0 }}</li>
            <li><strong>Étudiants inscrits: </strong> {{ $stats['students_count'] ?? 0 }}</li>
        </ul>
    </div>

    {{-- Notifications --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Dernières notifications</h2>
        <ul class="list-disc list-inside text-gray-700">
            @forelse($notifications as $notification)
                <li>{{ $notification->data['message'] ?? 'Notification' }}</li>
            @empty
                <li>Aucune notification récente.</li>
            @endforelse
        </ul>
    </div>
</div>

{{-- Script dropdown --}}
<script>
    document.getElementById('dropdownButton').addEventListener('click', function () {
        let menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    });
</script>
@endsection
