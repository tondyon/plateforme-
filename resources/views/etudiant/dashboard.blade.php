
{{-- resources/views/etudiant/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenue Étudiant !</h1>
    <p>Ceci est votre tableau de bord. Vous pouvez suivre vos cours, voir vos progrès et participer aux formations.</p>
</div>

<div class="container">
    <h2>Courses disponibles</h2>
    <ul>
        @foreach($availableCourses as $course)
            <li>
                {{ $course->title }}
                <form action="{{ route('courses.enroll', $course->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">S'inscrire</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

<div class="container">
    <h2>Vos cours</h2>
    <ul>
        @foreach($courses as $course)
            <li>{{ $course->title }}</li>
        @endforeach
    </ul>
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Vous êtes inscrit à {{ count($courses) }} cours</h3>
        </div>
        <div class="col-md-6">
            <h3>Suivi de vos progrès :</h3>
            <ul>
                @foreach($progress as $item)
                    <li>{{ $item['course']->title }} - {{ $item['progress'] }}%</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="progress-tracker">
    @foreach($courses as $course)
      <div class="course-progress">
        <h4>{{ $course->title }}</h4>
        <progress value="{{ $progress[$course->id] }}" max="100"></progress>
        @if($progress[$course->id] >= 100)
          <a href="{{ route('certificates.download', $certificates[$course->id]) }}">
            Télécharger certificat
          </a>
        @endif
      </div>
    @endforeach
</div>
@endsection
