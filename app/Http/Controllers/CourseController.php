<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Notifications\CourseEnrollmentNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CourseController extends Controller
{
      // Affiche la liste des cours
    public function index()
    {
        $courses = Course::latest()->get();  // Récupère tous les cours
        return view('courses.index', compact('courses'));
    }

      // Affiche un cours spécifique
    public function show(Course $course)
    {
        $similarCourses = Course::where('id', '!=', $course->id)
            ->where(function($query) use ($course) {
                $query->where('teacher_id', $course->teacher_id)
                    ->orWhere('category_id', $course->category_id);
            })
            ->take(3)
            ->get();

        return view('courses.show', compact('course', 'similarCourses'));
    }

      // Affiche le formulaire de création
    public function create()
    {
        return view('courses.create');
    }

      // Enregistre un nouveau cours
    public function store(Request $request)
    {
          // Validation des données envoyées
        $validated = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'image'       => 'nullable|image'     // Validation pour l'image
        ]);

          // Si un fichier image est téléchargé, on le stocke
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses');
        }

          // Création du cours avec les données validées
        Course::create($validated);

          // Redirection vers la liste des cours
        return redirect()->route('courses.index');
    }

      // Affiche le formulaire d'édition
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

      // Met à jour un cours existant
    public function update(Request $request, Course $course)
    {
          // Validation des données envoyées
        $validated = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'image'       => 'nullable|image'     // Validation pour l'image
        ]);

          // Si un fichier image est téléchargé, on le stocke
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses');
        }

          // Mise à jour du cours avec les données validées
        $course->update($validated);

          // Redirection vers la liste des cours
        return redirect()->route('courses.index');
    }

    public function formateurIndex()
    {
        $courses = Course::where('teacher_id', auth()->id())
            ->withCount(['enrolledStudents', 'completedStudents'])
            ->latest()
            ->get();

        return view('formateur.courses', compact('courses'));
    }

    public function etudiantIndex()
    {
        return $this->myCourses();
    }

    // Supprime un cours
    public function destroy(Course $course)
    {
        // Suppression du cours
        $course->delete();

        // Redirection vers la liste des cours
        return redirect()->route('courses.index');
    }

    /**
     * Affiche les cours de l'utilisateur connecté
     */
    public function myCourses()
    {
        $courses = auth()->user()->enrolledCourses()
            ->withPivot('progress', 'enrolled_at', 'completed_at')
            ->orderBy('enrolled_at', 'desc')
            ->get();

        return view('etudiant.courses', compact('courses'));
    }

    /**
     * Affiche les statistiques des cours (admin seulement)
     */
    public function statistics()
    {
        $this->authorize('viewAny', Course::class);

        $stats = [
            'total' => Course::count(),
            'active' => Course::where('is_active', true)->count(),
            'popular' => Course::withCount('enrollments')
                             ->orderBy('enrollments_count', 'desc')
                             ->take(5)
                             ->get()
        ];

        return view('admin.courses.statistics', compact('stats'));
    }

    public function completeCourse(Course $course)
    {
        $user = auth()->user();
        $user->completeCourse($course);

        // Ajouter de l'expérience pour avoir terminé le cours
        $user->addExperience(500, "Cours terminé : {$course->title}");

        event(new CourseCompleted($user, $course));

        return redirect()->route('courses.show', $course)
            ->with('success', 'Félicitations ! Vous avez terminé ce cours.');
    }

    /**
     * Inscrire l'utilisateur à un cours
     */
    public function enroll(Course $course)
    {
        $user = auth()->user();

        if (!$user->enrolledCourses->contains($course->id)) {
            $user->enrollInCourse($course);
            $user->notify(new CourseEnrollmentNotification($course));

            return redirect()->route('courses.show', $course)
                ->with('success', 'Vous êtes maintenant inscrit à ce cours.');
        }

        return redirect()->route('courses.show', $course)
            ->with('info', 'Vous êtes déjà inscrit à ce cours.');
    }

    public function updateProgress(Course $course, Request $request)
    {
        $validated = $request->validate([
            'progress' => 'required|integer|min:0|max:100'
        ]);

        $user = auth()->user();
        $enrollment = $user->enrolledCourses()
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'êtes pas inscrit à ce cours'
            ], 403);
        }

        $oldProgress = $enrollment->pivot->progress;
        $enrollment->pivot->progress = $validated['progress'];
        
        // Si le cours vient d'être complété
        if ($validated['progress'] == 100 && $oldProgress < 100) {
            $enrollment->pivot->completed_at = now();
            
            // Générer le code de vérification du certificat
            $course->generateCertificateCode($user->id);
            
            // Déclencher l'événement de complétion du cours
            event(new \App\Events\CourseCompleted($course, $user));
            
            // Ajouter des points d'expérience
            if (method_exists($user, 'addExperience')) {
                $user->addExperience(500, "Cours terminé : {$course->title}");
            }
        }
        
        $enrollment->pivot->save();

        return response()->json([
            'success' => true,
            'message' => 'Progression mise à jour avec succès',
            'data' => [
                'progress' => $validated['progress'],
                'isCompleted' => $validated['progress'] == 100
            ]
        ]);
    }

    public function certificate(Course $course)
    {
        $user = auth()->user();
        $enrollment = $user->enrolledCourses()->where('course_id', $course->id)->first();

        if (!$enrollment || $enrollment->pivot->progress < 100) {
            return redirect()->back()
                ->with('error', 'Vous devez terminer le cours avant de pouvoir télécharger le certificat.');
        }

        // Générer ou récupérer le code de vérification
        $verificationCode = $course->generateCertificateCode($user->id);

        $data = [
            'course' => $course,
            'user' => $user,
            'completion_date' => Carbon::parse($enrollment->pivot->completed_at)->format('d/m/Y'),
            'verification_code' => $verificationCode
        ];

        $pdf = Pdf::loadView('certificates.course', $data);

        return $pdf->download("certificat-{$course->slug}-{$user->id}.pdf");
    }
}
