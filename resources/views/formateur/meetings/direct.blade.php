@extends('layouts.app')
@section('title', 'Streaming Direct')
@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Streaming Direct</h2>
    <div x-data x-init="$el.classList.add('animate-fadeIn')" class="min-h-screen flex bg-gradient-to-r from-indigo-500 to-purple-600">
        @include('partials.sidebar')
        <main class="flex-1 ml-6 p-8 text-white">
            <h2 class="text-2xl font-bold mb-2">Streaming Direct</h2>
            <hr class="mx-auto my-4 border-t-2 border-white animate-lineGrow w-0" x-init="$el.classList.add('w-full')">
            <div class="w-full h-[600px] bg-black rounded overflow-hidden animate-fadeIn">
                <iframe src="{{ $jitsiUrl }}" allow="camera; microphone; fullscreen; display-capture" class="w-full h-full" frameborder="0"></iframe>
            </div>
        </main>
    </div>

    <style>
        .animate-fadeIn { animation: fadeIn 1s ease forwards; }
        @keyframes fadeIn { from { opacity:0;} to { opacity:1;} }
        .animate-lineGrow { animation: lineGrow 1s ease forwards; }
        @keyframes lineGrow { from { width:0;} to { width:100%;} }
    </style>
@endsection
