@extends('layouts.app')

@section('title', 'Mes Réunions')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Mes Réunions') }}</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if($meetings->isEmpty())
                    <p>{{ __('Aucune réunion prévue.') }}</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach($meetings as $meeting)
                            <li class="py-4 flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $meeting->title }}</h3>
                                    @if($meeting->scheduled_at)
                                        <p class="text-sm text-gray-600">{{ $meeting->scheduled_at->format('d/m/Y H:i') }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('etudiant.meetings.show', $meeting) }}" class="text-blue-500 hover:underline">
                                    {{ __('Rejoindre') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
