@extends('layouts.app')

@section('content')
<div x-data x-init="$el.classList.add('animate-fadeIn')"
     class="about-section relative w-full min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 to-blue-500">
    <div class="relative z-10 max-w-3xl mx-auto p-6 text-white space-y-6">
        <h1 class="text-4xl font-bold text-center">À propos de nous</h1>
        <hr class="mx-auto my-4 border-t-2 border-indigo-400 w-full animate-lineGrow">
        <p class="text-lg leading-relaxed">Bienvenue sur notre plateforme de formation. Nous sommes dédiés à fournir des cours de qualité pour aider nos utilisateurs à atteindre leurs objectifs professionnels et personnels. Notre mission est de rendre l'apprentissage accessible à tous, où que vous soyez.</p>
        <p class="text-lg leading-relaxed">Avec une équipe d'experts passionnés, nous proposons une variété de cours couvrant différents domaines, allant de la technologie à la gestion, en passant par le développement personnel.</p>
        <p class="text-lg leading-relaxed">Rejoignez-nous pour commencer votre parcours d'apprentissage dès aujourd'hui et découvrez un monde de possibilités.</p>
    </div>
</div>

<style>
.animate-fadeIn { animation: fadeIn 1s ease forwards; }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
.animate-lineGrow { animation: lineGrow 1s ease forwards; }
@keyframes lineGrow { from { width: 0; } to { width: 100%; } }
</style>
@endsection
