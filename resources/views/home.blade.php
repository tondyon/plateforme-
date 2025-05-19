@extends('layouts.app')

@section('content')
    <div class = "home-container">
    <div class = "hero-content">
    <h1  class = "neon-title">Bienvenue, {{ auth()->user()->name }} !</h1>
    <p   class = "hero-subtitle">Accédez à votre espace personnel et gérez vos formations</p>

            <div class = "home-buttons">
        <!-- Rediriger vers home -->
        <a href = "{{ route('home') }}" class = "btn-main">Tableau de Bord</a>

        <!-- Bouton de déconnexion -->
        <a href    = "{{ route('logout') }}" class = "btn-logout"
           onclick = "event.preventDefault(); document.getElementById('logout-form').submit();">
            Déconnexion
        </a>

        <form id = "logout-form" action = "{{ route('logout') }}" method = "POST" style = "display: none;">
            @csrf
        </form>
    </div>
</div>

<!-- Blocs d'informations personnalisées -->
<div class="dashboard-summary" style="display:flex;gap:24px;justify-content:center;margin-top:32px;flex-wrap:wrap;">
    <div class="card" style="min-width:220px;padding:24px;background:#f8fafc;border-radius:10px;box-shadow:0 2px 8px #0001;">
        <h2 style="font-size:1.4em;margin-bottom:8px;">Mes cours</h2>
        <p>Vous suivez <b>{{ count($courses) }}</b> cours.</p>
        <a href="{{ route('etudiant.courses') }}" class="btn-main" style="margin-top:10px;">Voir mes cours</a>
    </div>
    <div class="card" style="min-width:220px;padding:24px;background:#f8fafc;border-radius:10px;box-shadow:0 2px 8px #0001;">
        <h2 style="font-size:1.4em;margin-bottom:8px;">Prochain cours</h2>
        @if($nextCourse)
            <p><b>{{ $nextCourse->title }}</b></p>
            <p>{{ $nextCourse->start_date ? $nextCourse->start_date->format('d/m/Y H:i') : '' }}</p>
        @else
            <p>Aucun cours à venir</p>
        @endif
    </div>
    <div class="card" style="min-width:220px;padding:24px;background:#f8fafc;border-radius:10px;box-shadow:0 2px 8px #0001;">
        <h2 style="font-size:1.4em;margin-bottom:8px;">Progrès moyen</h2>
        <p><b>{{ $averageProgress }}%</b></p>
    </div>
</div>
@endsection
