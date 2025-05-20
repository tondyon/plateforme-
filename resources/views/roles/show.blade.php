@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Rôle : {{ ucfirst(str_replace('-', ' ', $role)) }}</h1>
    <p class="text-lg text-gray-700 mb-4">Bienvenue sur la page dédiée au rôle <span class="font-semibold text-blue-700">{{ ucfirst(str_replace('-', ' ', $role)) }}</span>.<br>
        Vous trouverez ici des parcours de formation, des compétences clés et des ressources pour évoluer dans ce métier.</p>
    <div class="mt-10">
        <a href="#" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">Découvrir les formations</a>
    </div>
</div>
@endsection
