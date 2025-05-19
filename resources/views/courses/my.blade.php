@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes Cours</h1>
    
    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <div class="progress mb-2">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $course->pivot->progress }}%" 
                                 aria-valuenow="{{ $course->pivot->progress }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ $course->pivot->progress }}%
                            </div>
                        </div>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-primary">Continuer</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Vous n'êtes inscrit à aucun cours pour le moment.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
