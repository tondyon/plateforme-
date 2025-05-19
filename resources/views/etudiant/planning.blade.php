@extends('layouts.app')

@section('title', 'Planning des Cours')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Planning des Cours') }}</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if($courses->isEmpty())
                    <p>{{ __('Vous n’êtes inscrit à aucun cours.') }}</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Cours') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Inscrit le') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Progression') }}</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($courses as $course)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->pivot->enrolled_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $course->pivot->progress }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-900">{{ __('Voir le cours') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
