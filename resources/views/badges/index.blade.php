<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Badges') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Badges gagnés -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Badges Obtenus</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($earnedBadges as $badge)
                        <div class="border rounded-lg p-4 flex flex-col items-center">
                            <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="w-16 h-16 mb-2">
                            <h4 class="font-medium text-gray-900">{{ $badge->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $badge->description }}</p>
                            <span class="mt-2 text-xs text-gray-500">
                                Obtenu le {{ $badge->pivot->awarded_at->format('d/m/Y') }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-full">Vous n'avez pas encore obtenu de badge.</p>
                    @endforelse
                </div>
            </div>

            <!-- Badges disponibles -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Badges à Débloquer</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($availableBadges as $badge)
                        <div class="border rounded-lg p-4 flex flex-col items-center opacity-50">
                            <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="w-16 h-16 mb-2 filter grayscale">
                            <h4 class="font-medium text-gray-900">{{ $badge->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $badge->description }}</p>
                            <a href="{{ route('badges.show', $badge) }}" class="mt-2 text-indigo-600 hover:text-indigo-900 text-sm">
                                Voir les conditions
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-full">Vous avez débloqué tous les badges disponibles !</p>
                    @endforelse
                </div>
            </div>

            <!-- Tableau des leaders -->
            <div class="mt-6">
                <a href="{{ route('badges.leaderboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Voir le Classement
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
