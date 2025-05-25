@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Journal des activités</h1>

    <!-- Formulaire de filtrage -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="superviseur" class="form-control" placeholder="Superviseur" value="{{ request('superviseur') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="action" class="form-control" placeholder="Action" value="{{ request('action') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Tableau des logs -->
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Utilisateur</th>
                <th>Action</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->details }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@endsection
