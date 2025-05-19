<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $badge->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-start space-x-6">
                    <!-- Badge Icon et Informations -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset($badge->icon) }}"
                             alt="{{ $badge->name }}"
                             class="w-32 h-32 {{ $userHasBadge ? '' : 'filter grayscale opacity-50' }}">
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $badge->name }}</h3>
                        <p class="mt-2 text-gray-600">{{ $badge->description }}</p>

                        <!-- Status du Badge -->
                        <div class="mt-4">
                            @if($userHasBadge)
                                <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Badge Obtenu
                                </div>
                            @else
                                <!-- Progression -->
                                @if($progress !== null)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-900">Progression</h4>
                                        <div class="mt-2 relative pt-1">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                                                <div style="width: {{ $progress }}%"
                                                     class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                                                </div>
                                            </div>
                                            <span class="text-xs text-gray-600 mt-1">{{ round($progress) }}% complété</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Critères -->
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-900">Conditions d'obtention :</h4>
                                    <ul class="mt-2 list-disc list-inside text-sm text-gray-600">
                                        @foreach((array)$badge->criteria as $key => $value)
                                            <li>
                                                @switch($key)
                                                    @case('completed_courses_count')
                                                        Compléter {{ $value }} cours
                                                        @break
                                                    @case('quiz_score')
                                                        Obtenir un score de {{ $value }}% à un quiz
                                                        @break
                                                    @case('consecutive_days')
                                                        Se connecter {{ $value }} jours consécutifs
                                                        @break
                                                    @default
                                                        {{ $key }}: {{ $value }}
                                                @endswitch
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bouton Retour -->
            <div class="mt-6">
                <a href="{{ route('badges.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Retour aux Badges
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
