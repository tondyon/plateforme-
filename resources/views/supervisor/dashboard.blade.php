@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Espace Superviseur</h1>
    
    <div class="card">
        <div class="card-body">
            <h3>Permissions actuelles :</h3>
            <ul>
                <li>Voir les statistiques : {{ auth()->user()->hasPermission('view_statistics') ? '✅' : '❌' }}</li>
                <li>Exporter des données : {{ auth()->user()->hasPermission('export_data') ? '✅' : '❌' }}</li>
            </ul>
            <div class="mt-4">
                <a href="/supervisor/export-courses" class="btn btn-primary" 
                   {{ !auth()->user()->hasPermission('export_data') ? 'disabled' : '' }}>
                   Exporter les cours (CSV)
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
