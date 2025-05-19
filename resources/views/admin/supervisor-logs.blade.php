@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Logs des superviseurs</h1>
    <form method="GET" action="{{ route('logs.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="date" name="date" value="{{ request('date') }}" class="form-control" placeholder="Date">
        </div>
        <div class="col-md-3">
            <input type="text" name="superviseur" value="{{ request('superviseur') }}" class="form-control" placeholder="Nom du superviseur">
        </div>
        <div class="col-md-3">
            <input type="text" name="action" value="{{ request('action') }}" class="form-control" placeholder="Action">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Superviseur</th>
                <th>Action</th>
                <th>Détails</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->action }}</td>
                    <td>
                        @if($log->details)
                            <pre>{{ json_encode($log->details, JSON_PRETTY_PRINT) }}</pre>
                        @endif
                    </td>
                    <td>{{ $log->ip_address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
