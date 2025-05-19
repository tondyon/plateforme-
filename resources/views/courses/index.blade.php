<style>
    body {
        background: #f4f6fa !important;
    }
    .catalogue-bg {
        background: #f4f6fa;
        min-height: 100vh;
        padding: 40px 0;
    }
    .course-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(60,60,60,0.08);
        overflow: hidden;
        transition: box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .course-card:hover {
        box-shadow: 0 8px 32px rgba(60,60,60,0.15);
    }
    .course-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }
    .course-card .p-6 {
        padding: 1.5rem;
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .course-card h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 0.5rem;
    }
    .course-card .text-gray-600 {
        color: #555;
        font-size: 1rem;
        margin-bottom: 1rem;
    }
    .course-card .progress-bar {
        background: #e5e7eb;
        border-radius: 8px;
        height: 8px;
        margin-bottom: 0.25rem;
        overflow: hidden;
    }
    .course-card .progress-bar-inner {
        background: #22c55e;
        height: 8px;
        border-radius: 8px;
    }
    .course-card .badge {
        background: #facc15;
        color: #fff;
        font-size: 0.75rem;
        font-weight: bold;
        border-radius: 999px;
        padding: 0.2em 0.8em;
        margin-left: 0.5em;
    }
    .course-card .btn-main {
        display: inline-block;
        background: #2563eb;
        color: #fff;
        border-radius: 8px;
        padding: 0.5em 1.2em;
        font-weight: 600;
        margin-top: 1em;
        margin-right: 0.5em;
        transition: background 0.2s;
        text-decoration: none;
    }
    .course-card .btn-main:hover {
        background: #1e40af;
    }
    .course-card .btn-secondary {
        display: inline-block;
        background: #a21caf;
        color: #fff;
        border-radius: 8px;
        padding: 0.3em 1em;
        font-size: 0.9em;
        margin-top: 1em;
        margin-right: 0.5em;
        transition: background 0.2s;
        text-decoration: none;
    }
    .course-card .btn-secondary:hover {
        background: #701a75;
    }
    .course-card .btn-enroll {
        background: #f59e42;
        color: #fff;
        border-radius: 8px;
        padding: 0.4em 1em;
        font-weight: 600;
        margin-top: 1em;
        border: none;
        transition: background 0.2s;
        cursor: pointer;
    }
    .course-card .btn-enroll:hover {
        background: #d97706;
    }
</style>
<div class="catalogue-bg">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @foreach($courses as $course)
        <div class="course-card relative">
            {{-- Badge de gamification --}}
            @if(!empty($course->is_popular))
                <span class = "absolute top-2 right-2 bg-yellow-400 text-white px-2 py-1 rounded-full text-xs font-bold">Populaire</span>
            @endif

            {{-- Image du cours --}}
            <img src="{{ $course->image ?? 'https://via.placeholder.com/400x200' }}"
     alt="{{ $course->title }}">

            <div class="p-6">
            <h2 class="flex items-center gap-2">
    {{ $course->title }}
    @if(!empty($course->is_popular))
        <span class="badge">Populaire</span>
    @endif
    @if(!empty($course->has_video))
        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4v12l12-6-12-6z"/></svg>
    @endif
</h2>
                <p class="text-gray-600">{{ Str::limit($course->description, 100) }}</p>

                {{-- Progression personnalisée --}}
                @auth
                    @if(auth()->user()->enrolledCourses->contains($course))
                        <div class="progress-bar mt-2">
    <div class="progress-bar-inner" style="width: {{ auth()->user()->courseProgress($course) }}%"></div>
</div>
<span class="text-xs text-gray-500">Progression : {{ auth()->user()->courseProgress($course) }}%</span>
                        {{-- Badges --}}
                        <div class = "mt-2 flex flex-wrap gap-1">
                            @foreach(auth()->user()->badges as $badge)
                                <span class = "bg-yellow-300 text-xs px-2 py-1 rounded">{{ $badge->name }}</span>
                            @endforeach
                        </div>
                    @endif
                @endauth

                <a href="{{ route('courses.show', $course) }}" class="btn-main">Voir le cours</a>

                {{-- Forum/Questions --}}
                <a href="{{ route('courses.forum', $course) }}" class="btn-secondary">Forum / Q&R</a>

                @auth
                    @if(! auth()->user()->enrolledCourses->contains($course))
                        @if($course->price > 0)
                            <a href="{{ route('courses.checkout', $course) }}" class="mt-2 px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Acheter ({{ number_format($course->price,2) }}€)</a>
                        @else
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-enroll">S'inscrire</button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    @endforeach
</div>
