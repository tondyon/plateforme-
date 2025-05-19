@extends('layouts.app')

@section('content')
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-900 via-indigo-900 to-purple-900 min-h-screen">
        <div class="max-w-7xl mx-auto py-8 px-4">
            <div class="mb-8">
                <h1 class="text-3xl font-bold mb-2 animate-fade-in text-white drop-shadow">Bienvenue, {{ Auth::user()->name }} !</h1>
                <p class="text-lg text-blue-100">Heureux de vous retrouver sur la plateforme de formation.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-blue-800/90 rounded-lg shadow p-6 flex flex-col items-center animate-bounce-in">
                    <span class="text-4xl font-bold text-white">{{ $coursesCount ?? 0 }}</span>
                    <span class="text-lg text-blue-100">Cours suivis</span>
                </div>
                <div class="bg-indigo-800/90 rounded-lg shadow p-6 flex flex-col items-center animate-bounce-in delay-150">
                    <span class="text-4xl font-bold text-white">{{ $meetingsCount ?? 0 }}</span>
                    <span class="text-lg text-blue-100">Réunions</span>
                </div>
                <div class="bg-purple-800/90 rounded-lg shadow p-6 flex flex-col items-center animate-bounce-in delay-300">
                    <span class="text-4xl font-bold text-white">{{ $notificationsCount ?? 0 }}</span>
                    <span class="text-lg text-blue-100">Notifications</span>
                </div>
            </div>
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-white">À la une</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white/10 rounded-lg p-6 flex flex-col gap-2 hover:scale-105 transition-transform duration-200 animate-fade-in">
                        <h3 class="font-bold text-lg text-white">Nouveaux cours disponibles</h3>
                        <p class="text-blue-100">Découvrez les dernières formations ajoutées à la plateforme !</p>
                        <a href="{{ route('courses.index') }}" class="inline-block mt-2 px-4 py-2 bg-blue-700 rounded text-white font-semibold shadow hover:bg-blue-800 transition-all duration-200">Voir les cours</a>
                    </div>
                    <div class="bg-white/10 rounded-lg p-6 flex flex-col gap-2 hover:scale-105 transition-transform duration-200 animate-fade-in delay-150">
                        <h3 class="font-bold text-lg text-white">Participez à une réunion</h3>
                        <p class="text-blue-100">Rejoignez vos réunions programmées ou planifiez-en une nouvelle.</p>
                        <a href="{{ route('formateur.meetings.index') }}" class="inline-block mt-2 px-4 py-2 bg-indigo-700 rounded text-white font-semibold shadow hover:bg-indigo-800 transition-all duration-200">Voir les réunions</a>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mb-8">
                <a href="{{ route('courses.index') }}" class="px-8 py-3 bg-gradient-to-r from-blue-700 to-indigo-700 rounded-full text-white text-lg font-bold shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-200 animate-pulse">
                    Accéder à tous les cours
                </a>
            </div>
        </div>
        <!-- Section Actualités dynamiques -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Actualités de la plateforme</h2>
                <ul class="list-disc pl-6 text-gray-700">
                    @forelse($news as $item)
                        <li>
                            <strong>{{ $item->title }}</strong><br>
                            <span class="text-sm text-gray-500">{{ $item->created_at->format('d/m/Y') }}</span>
                            <p>{{ $item->content }}</p>
                        </li>
                    @empty
                        <li>Aucune actualité pour le moment.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Section Cours récents -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Mes cours récents</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($currentCourses as $course)
                        <div class="border rounded-lg p-4 bg-blue-50">
                            <h3 class="font-semibold text-lg text-blue-900">{{ $course->title }}</h3>
                            <p class="text-blue-800">{{ $course->description ?? 'Pas de description.' }}</p>
                            <a href="{{ route('courses.show', $course->id) }}" class="text-blue-600 hover:underline">Voir le cours</a>
                        </div>
                    @endforeach
                    @if($currentCourses->isEmpty())
                        <p class="text-gray-500">Aucun cours en cours.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section Statistiques et Graphiques -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Statistiques</h2>
                <div class="flex flex-wrap gap-8 mb-8">
                    <div class="flex flex-col items-center">
                        <span class="text-3xl font-bold text-blue-700">{{ $stats['level'] ?? 0 }}</span>
                        <span class="text-gray-700">Niveau</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-3xl font-bold text-indigo-700">{{ $stats['experience'] ?? 0 }}</span>
                        <span class="text-gray-700">Points d'expérience</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-3xl font-bold text-purple-700">{{ $stats['badges_count'] ?? 0 }}</span>
                        <span class="text-gray-700">Badges</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-3xl font-bold text-green-700">{{ $stats['completed_courses'] ?? 0 }}</span>
                        <span class="text-gray-700">Cours terminés</span>
                    </div>
                </div>
                <!-- Graphiques -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Répartition de vos cours (barres)</h3>
                        <canvas id="barChart" height="120"></canvas>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Répartition de vos cours (camembert)</h3>
                        <canvas id="pieChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var barCtx = document.getElementById('barChart').getContext('2d');
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['En cours', 'Terminés', 'Non commencés'],
                    datasets: [{
                        label: 'Nombre de cours',
                        data: [{{ $chartData['enCours'] ?? 0 }}, {{ $chartData['termines'] ?? 0 }}, {{ $chartData['nonCommences'] ?? 0 }}],
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e42'],
                    }]
                }
            });
            var pieCtx = document.getElementById('pieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['En cours', 'Terminés', 'Non commencés'],
                    datasets: [{
                        data: [{{ $chartData['enCours'] ?? 0 }}, {{ $chartData['termines'] ?? 0 }}, {{ $chartData['nonCommences'] ?? 0 }}],
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e42'],
                    }]
                }
            });
        });
        </script>

        <!-- Liste des formations (tous les cours) -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Liste des formations</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Formateur</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date de début</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach(\App\Models\Course::latest()->take(10)->get() as $course)
                                <tr>
                                    <td class="px-4 py-2">{{ $course->title }}</td>
                                    <td class="px-4 py-2">{{ $course->teacher->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $course->start_date ? $course->start_date->format('d/m/Y') : 'Non défini' }}</td>
                                    <td class="px-4 py-2">
                                        @if($course->is_active)
                                            <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full text-xs">Active</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-200 text-gray-800 rounded-full text-xs">Inactif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('courses.show', $course->id) }}" class="text-blue-600 hover:underline">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifications -->
            @if($notifications->count() > 0)
                <div class="mb-6">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notifications récentes</h3>
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-lg {{ $notification->read_at ? 'opacity-50' : '' }}">
                                    @if($notification->type === 'App\\Notifications\\BadgeEarnedNotification')
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-green-100">
                                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Nouveau badge obtenu !</p>
                                            <p class="mt-1 text-sm text-gray-500">{{ $notification->data['badge_name'] }}</p>
                                            <div class="mt-2">
                                                <a href="{{ route('badges.show', $notification->data['badge_id']) }}"
                                                   class="text-sm text-indigo-600 hover:text-indigo-900">
                                                    Voir le badge →
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    @if($notification->type === 'App\\Notifications\\ExperienceGainedNotification')
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">+{{ $notification->data['points'] }} points d'expérience !</p>
                                            <p class="mt-1 text-sm text-gray-500">{{ $notification->data['reason'] }}</p>
                                        </div>
                                    @endif

                                    @if(!$notification->read_at)
                                        <div class="flex-shrink-0">
                                            <form method="POST" action="{{ route('notifications.mark-as-read', $notification->id) }}">
                                                @csrf
                                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                                    Marquer comme lu
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Barre d'expérience et niveau -->
            @include('partials.experience-bar')

            <!-- Grille des statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <!-- Carte des badges -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Badges Récents</h3>
                    <div class="space-y-4">
                        @forelse (auth()->user()->badges()->latest()->take(3)->get() as $badge)
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="w-10 h-10">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $badge->name }}</div>
                                    <div class="text-sm text-gray-500">Obtenu le {{ $badge->pivot->awarded_at->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Aucun badge obtenu pour le moment.</p>
                        @endforelse
                        <a href="{{ route('badges.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                            Voir tous les badges →
                        </a>
                    </div>
                </div>

                <!-- Carte des cours en cours -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Mes Cours en Cours</h3>
                    <div class="space-y-4">
                        @forelse (auth()->user()->enrolledCourses()->latest()->take(3)->get() as $course)
                            <div>
                                <div class="flex justify-between items-center">
                                    <div class="font-medium text-gray-900">{{ $course->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $course->pivot->progress }}%</div>
                                </div>
                                <div class = "mt-2 w-full bg-gray-200 rounded-full h-2">
                                <div class = "bg-green-600 h-2 rounded-full" style = "width: {{ $course->pivot->progress }}%">
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Aucun cours en cours.</p>
                        @endforelse
                        <a href="{{ route('courses.my') }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                            Voir tous mes cours →
                        </a>
                    </div>
                </div>

                <!-- Carte des statistiques -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Mes Statistiques</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Niveau actuel</span>
                            <span class="font-medium">{{ auth()->user()->level }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Points d'expérience</span>
                            <span class="font-medium">{{ auth()->user()->experience_points }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Badges obtenus</span>
                            <span class="font-medium">{{ auth()->user()->badges->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Cours complétés</span>
                            <span class="font-medium">{{ auth()->user()->enrolledCourses()->wherePivot('progress', 100)->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suggestions de cours -->
            <div class="mt-6 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Cours Recommandés</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach (\App\Models\Course::inRandomOrder()->take(3)->get() as $course)
                        <div class="border rounded-lg p-4">
                            <h4 class="font-medium text-gray-900">{{ $course->title }}</h4>
                            <p class="text-sm text-gray-500 mt-2">{{ Str::limit($course->description, 100) }}</p>
                            <a href="{{ route('courses.show', $course) }}"
                               class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                En savoir plus
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
