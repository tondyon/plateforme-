@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <!-- Image du cours -->
        <img src="{{ $course->image ?? 'https://via.placeholder.com/800x400' }}"
             alt="{{ $course->title }}"
             class="w-full h-64 object-cover">

        <div class="p-8">
            <!-- En-tête du cours -->
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
                    <p class="text-gray-500 mt-2">
                        Formateur:
                        @if($course->teacher)
                            {{ $course->teacher->name }}
                        @else
                            <span class="italic text-red-400">Non attribué</span>
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    @if(auth()->check())
    @if(!auth()->user()->enrolledCourses->contains($course))
        <div class="flex flex-col items-end">
            <div class="mb-2 text-lg font-semibold">
                Prix du cours :
                @if($course->price == 0)
                    <span class="text-green-600 font-bold">Gratuit</span>
                @else
                    <span class="text-blue-700 font-bold">{{ number_format($course->price, 2) }} €</span>
                @endif
            </div>
            @if($course->price == 0)
                <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        S'inscrire gratuitement
                    </button>
                </form>
            @else
                <a href="{{ route('courses.checkout', $course->id) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Payer et s'inscrire
                </a>
            @endif
        </div>
                        @else
                            <div class="flex flex-col items-center">
                                <div class="text-sm text-gray-600 mb-2">Progression du cours</div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                    @if($course->pivot)
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $course->pivot->progress }}%"></div>
                                        <span class="text-sm text-gray-600">{{ $course->pivot->progress }}% complété</span>
                                    @else
                                        <div class="bg-gray-300 h-2.5 rounded-full" style="width: 0%"></div>
                                        <span class="text-sm text-gray-600">0% complété</span>
                                    @endif
                                </div>
                                <a href="#course-content" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Continuer le cours
                                </a>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Se connecter pour s'inscrire
                        </a>
                    @endif
                </div>
            </div>

            <!-- Description du cours -->
            <div class="prose max-w-none mt-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">À propos de ce cours</h2>
                <p class="text-gray-700">{{ $course->description }}</p>
            </div>

            @if(auth()->check() && auth()->user()->enrolledCourses->contains($course))
                <!-- Contenu du cours (visible uniquement pour les inscrits) -->
                <div id="course-content" class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Contenu du cours</h2>
                    <!-- Ajoutez ici le contenu du cours -->
                </div>
            @endif

            <!-- Cours similaires -->
            @if(isset($similarCourses) && $similarCourses->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Cours similaires</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($similarCourses as $similarCourse)
                            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                <h3 class="font-medium text-gray-900">{{ $similarCourse->title }}</h3>
                                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($similarCourse->description, 100) }}</p>
                                <a href="{{ route('courses.show', $similarCourse) }}"
                                   class="mt-4 inline-flex items-center text-sm text-indigo-600 hover:text-indigo-900">
                                    En savoir plus →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Bouton de retour -->
            <div class="mt-8">
                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour aux cours
                </a>
            </div>
        </div>
    </div>

    <!-- Modale de confirmation d'inscription -->
    <x-dialog-modal wire:model="confirmingEnrollment" id="confirm-enrollment">
        <x-slot name="title">
            Confirmer l'inscription
        </x-slot>

        <x-slot name="content">
            <p class="text-gray-700">
                Êtes-vous sûr de vouloir vous inscrire au cours "{{ $course->title }}" ?
            </p>
            <div class="mt-4">
                <h4 class="text-sm font-medium text-gray-900">Ce que vous obtiendrez :</h4>
                <ul class="mt-2 list-disc list-inside text-sm text-gray-600">
                    <li>Accès complet au contenu du cours</li>
                    <li>Certificat après complétion</li>
                    <li>Support du formateur</li>
                    <li>Points d'expérience pour votre progression</li>
                </ul>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <x-secondary-button @click="$dispatch('close')">
                    Annuler
                </x-secondary-button>

                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                    @csrf
                    <x-button type="submit" class="bg-green-600 hover:bg-green-700">
                        Confirmer l'inscription
                    </x-button>
                </form>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.addEventListener('enrollment-confirmed', () => {
            Swal.fire({
                title: 'Inscription confirmée !',
                text: 'Vous êtes maintenant inscrit au cours. Bonne formation !',
                icon: 'success',
                confirmButtonText: 'Commencer',
                confirmButtonColor: '#10B981'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        });
    });
</script>
@endpush
