@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Logs des Cours</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5>Filtres</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.courses.logs') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <label for="superviseur" class="form-label">Superviseur</label>
                    <input type="text" class="form-control" id="superviseur" name="superviseur" value="{{ request('superviseur') }}">
                </div>
                <div class="col-md-3">
                    <label for="action" class="form-label">Action</label>
                    <input type="text" class="form-control" id="action" name="action" value="{{ request('action') }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                    <a href="{{ route('admin.courses.logs') }}" class="btn btn-secondary ms-2">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
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
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
