@extends('layouts.app')
@section('title', $direct->title)
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">{{ $direct->title }}</h1>
    <p class="mb-4">{{ $direct->description }}</p>
    <div class="mb-6">
        <a href="{{ $direct->video_url }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded font-bold inline-block">
            Rejoindre le direct
        </a>
    </div>
    <div class="text-gray-600 text-sm">
        Lien du direct : <a href="{{ $direct->video_url }}" target="_blank" class="underline">{{ $direct->video_url }}</a>
    </div>
</div>
@endsection
