@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-8">
            @if(isset($enrollment))
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Certificat authentique</h2>
                    <p class="text-gray-600">Ce certificat a été validé avec succès.</p>
                </div>

                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Étudiant</h3>
                            <p class="mt-1 text-lg text-gray-900">{{ $enrollment->user->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Cours</h3>
                            <p class="mt-1 text-lg text-gray-900">{{ $enrollment->course->title }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Date de certification</h3>
                            <p class="mt-1 text-lg text-gray-900">{{ $enrollment->pivot->completed_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Formateur</h3>
                            <p class="mt-1 text-lg text-gray-900">{{ $enrollment->course->teacher->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-500">Code de vérification</p>
                    <p class="mt-1 font-mono bg-gray-100 px-3 py-1 rounded inline-block text-gray-700">
                        {{ $enrollment->pivot->certificate_verification_code }}
                    </p>
                </div>
            @else
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Certificat non valide</h2>
                    <p class="text-gray-600">Le certificat n'a pas pu être validé. Veuillez vérifier le code et réessayer.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
