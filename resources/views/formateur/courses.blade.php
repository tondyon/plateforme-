@extends('layouts.app')

@section('content')
<style>
    .instructor-summary {
        display: flex;
        gap: 32px;
        justify-content: flex-start;
        margin-bottom: 32px;
        flex-wrap: wrap;
    }
    .instructor-summary-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px #0001;
        padding: 24px 32px;
        min-width: 220px;
        text-align: center;
    }
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 32px;
    }
    .course-card-instructor {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(60,60,60,0.08);
        padding: 28px 22px 18px 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 170px;
    }
    .course-card-instructor h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 0.8em;
    }
    .course-card-instructor .actions {
        margin-top: 18px;
        display: flex;
        gap: 12px;
    }
    .btn-edit {
        color: #2563eb;
        font-weight: 500;
        text-decoration: none;
        padding: 0.4em 1.1em;
        border-radius: 8px;
        background: #e0e7ff;
        transition: background 0.2s;
    }
    .btn-edit:hover {
        background: #c7d2fe;
    }
    .btn-delete {
        color: #dc2626;
        font-weight: 500;
        text-decoration: none;
        padding: 0.4em 1.1em;
        border-radius: 8px;
        background: #fee2e2;
        transition: background 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-delete:hover {
        background: #fecaca;
    }
    .btn-create-course {
        background: #16a34a;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.7em 2em;
        font-size: 1.1em;
        box-shadow: 0 2px 8px #0001;
        text-decoration: none;
        margin-bottom: 18px;
        display: inline-block;
        transition: background 0.2s;
    }
    .btn-create-course:hover {
        background: #15803d;
    }
</style>
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Espace Formateur — Mes cours</h1>
    <div class="instructor-summary">
        <div class="instructor-summary-card">
            <div style="font-size:2.1em;font-weight:700;">{{ count($courses) }}</div>
            <div style="color:#888;">Cours créés</div>
        </div>
        <div class="instructor-summary-card">
            <div style="font-size:2.1em;font-weight:700;">{{ $totalStudents ?? '—' }}</div>
            <div style="color:#888;">Étudiants inscrits</div>
        </div>
        <div class="instructor-summary-card">
            <div style="font-size:2.1em;font-weight:700;">{{ $averageProgress ?? '—' }}%</div>
            <div style="color:#888;">Progression moyenne</div>
        </div>
    </div>
    <a href="{{ route('formateur.courses.create') }}" class="btn-create-course">Créer un nouveau cours</a>
    <div class="courses-grid mt-6">
        @forelse($courses as $course)
            <div class="course-card-instructor">
                <h3>{{ $course->title }}</h3>
                <div style="color:#555;font-size:1em;margin-bottom:1em;">
                    {{ Str::limit($course->description, 90) }}
                </div>
                <div class="actions">
                    <a href="{{ route('formateur.courses.edit', $course) }}" class="btn-edit">Modifier</a>
                    <form action="{{ route('formateur.courses.destroy', $course) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Supprimer ce cours ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="course-card-instructor" style="text-align:center;">Aucun cours trouvé.</div>
        @endforelse
    </div>
</div>
@endsection
