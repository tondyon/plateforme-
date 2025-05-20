<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    ContactController,
    CourseController,
    DashboardController,
    CertificateController,
    BadgeController,
    FormateurDashboardController,
    DirectController,
    CourseFileController,
    MeetingController,
    TestPermissionController,
    Auth\GoogleController
};

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome');
Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services');
Route::view('/carrieres', 'carrieres')->name('carrieres');
Route::view('/apropos', 'apropos')->name('apropos');

Route::get('/verify-certificate/{code}', [CertificateController::class, 'verify'])
    ->name('certificates.verify')
    ->middleware('rate.limit.certificates');

/*
|--------------------------------------------------------------------------
| Routes Authentifiées
|--------------------------------------------------------------------------
*/
// Route pour envoyer le lien de vérification d'email
Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Le lien de vérification a été envoyé !');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Dashboard général
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contact
    Route::get('/contact', [ContactController::class, 'create'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    // Profil utilisateur
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Cours
    Route::prefix('cours')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/creer', [CourseController::class, 'create'])->name('create');
        Route::post('/', [CourseController::class, 'store'])->name('store');
        Route::get('/{course}', [CourseController::class, 'show'])->name('show');
        Route::get('/{course}/editer', [CourseController::class, 'edit'])->name('edit');
        Route::put('/{course}', [CourseController::class, 'update'])->name('update');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
        Route::get('/{course}/forum', fn($course) => view('courses.forum', ['courseId' => $course]))->name('forum');
        Route::get('/{course}/certificate', [CourseController::class, 'certificate'])->name('certificate');
        Route::post('/{course}/progress', [CourseController::class, 'updateProgress'])->name('progress.update');
        Route::post('/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');
    });

    // Mes cours
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');

    // Badges
    Route::prefix('badges')->name('badges.')->group(function () {
        Route::get('/', [BadgeController::class, 'index'])->name('index');
        Route::get('/{badge}', [BadgeController::class, 'show'])->name('show');
        Route::get('/leaderboard', [BadgeController::class, 'leaderboard'])->name('leaderboard');
    });

    // Notifications
    Route::post('/notifications/{notification}/mark-as-read', function ($notificationId) {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.mark-as-read');

    // Test des permissions
    Route::get('/test-permissions', [TestPermissionController::class, 'checkSupervisorPermissions']);

    /*
    |--------------------------------------------------------------------------
    | Routes Formateur
    |--------------------------------------------------------------------------
    */
    // Route publique pour la liste des réunions formateur
Route::get('/formateur/meetings', [MeetingController::class, 'index'])->name('formateur.meetings.index');
// Route publique pour la page direct formateur
Route::get('/formateur/direct', fn() => view('formateur.meetings.direct', ['jitsiUrl' => 'https://meet.jit.si/' . uniqid('direct_')]))->name('formateur.direct');

Route::get('/formateur/courses', [\App\Http\Controllers\FormateurCourseController::class, 'index'])->name('formateur.courses.index');
Route::get('/formateur/courses/create', [\App\Http\Controllers\FormateurCourseController::class, 'create'])->name('formateur.courses.create');
Route::get('/formateur/courses/{course}/edit', [\App\Http\Controllers\FormateurCourseController::class, 'edit'])->name('formateur.courses.edit');
Route::delete('/formateur/courses/{course}', [\App\Http\Controllers\FormateurCourseController::class, 'destroy'])->name('formateur.courses.destroy');

Route::get('/formateur/dashboard', [FormateurDashboardController::class, 'index'])->name('formateur.dashboard');

    Route::get('/formateur/courses/files', [CourseFileController::class, 'index'])->name('formateur.courses.files.index');
    Route::get('/formateur/courses/files/create', [CourseFileController::class, 'create'])->name('formateur.courses.files.create');
    Route::post('/formateur/courses/files', [CourseFileController::class, 'store'])->name('formateur.courses.files.store');
    Route::get('/formateur/courses/files/{file}', [CourseFileController::class, 'show'])->name('formateur.courses.files.show');
    Route::delete('/formateur/courses/files/{file}', [CourseFileController::class, 'destroy'])->name('formateur.courses.files.destroy');

    Route::get('/formateur/direct', fn() => view('formateur.meetings.direct', ['jitsiUrl' => 'https://meet.jit.si/' . uniqid('direct_')]))->name('formateur.direct');
    Route::get('/formateur/direct/create', [DirectController::class, 'create'])->name('formateur.direct.create');
    Route::post('/formateur/direct', [DirectController::class, 'store'])->name('formateur.direct.store');
    Route::get('/formateur/direct/{direct}', [DirectController::class, 'show'])->name('formateur.direct.show');
Route::get('/formateur/courses/files', [CourseFileController::class, 'index'])->name('formateur.courses.files.index');
Route::get('/formateur/courses/files/create', [CourseFileController::class, 'create'])->name('formateur.courses.files.create');
Route::post('/formateur/courses/files', [CourseFileController::class, 'store'])->name('formateur.courses.files.store');
Route::get('/formateur/courses/files/{file}', [CourseFileController::class, 'show'])->name('formateur.courses.files.show');
Route::delete('/formateur/courses/files/{file}', [CourseFileController::class, 'destroy'])->name('formateur.courses.files.destroy');

// Directs
Route::get('/formateur/direct', fn() => view('formateur.meetings.direct', ['jitsiUrl' => 'https://meet.jit.si/' . uniqid('direct_')]))->name('formateur.direct');
Route::get('/formateur/direct/create', [DirectController::class, 'create'])->name('formateur.direct.create');
Route::post('/formateur/direct', [DirectController::class, 'store'])->name('formateur.direct.store');
Route::get('/formateur/direct/{direct}', [DirectController::class, 'show'])->name('formateur.direct.show');

// Réunions
Route::get('/formateur/meetings', [MeetingController::class, 'index'])->name('formateur.meetings.index');
Route::get('/formateur/meetings/create', [MeetingController::class, 'create'])->name('formateur.meetings.create');
Route::post('/formateur/meetings', [MeetingController::class, 'store'])->name('formateur.meetings.store');
Route::get('/formateur/meetings/{meeting}', [MeetingController::class, 'show'])->name('formateur.meetings.show');
Route::get('/formateur/meetings/{meeting}/edit', [MeetingController::class, 'edit'])->name('formateur.meetings.edit');
Route::put('/formateur/meetings/{meeting}', [MeetingController::class, 'update'])->name('formateur.meetings.update');
Route::delete('/formateur/meetings/{meeting}', [MeetingController::class, 'destroy'])->name('formateur.meetings.destroy');
// --- Fin des routes formateur publiques ---

// Route dynamique pour les rôles (mega menu)
Route::get('/roles/{role}', function($role) {
    // Affiche une page de rôle simple, à personnaliser plus tard
    return view('roles.show', ['role' => $role]);
})->name('roles.show');


    /*
    |--------------------------------------------------------------------------
    | Routes Étudiant
    |--------------------------------------------------------------------------
    */
    Route::prefix('etudiant')->name('etudiant.')->middleware('can:etudiant')->group(function () {
        Route::get('/courses', [CourseController::class, 'etudiantIndex'])->name('courses');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes Supervisor
    |--------------------------------------------------------------------------
    */
    Route::prefix('supervisor')->name('supervisor.')->middleware('supervisor')->group(function () {
        Route::get('/dashboard', fn() => view('supervisor.dashboard'))->name('dashboard');
        Route::get('/export-courses', [\App\Http\Controllers\Supervisor\ExportController::class, 'exportCourses'])->name('export-courses');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes Administrateur
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->middleware('can:admin')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        // Gestion des cours
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CourseController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\CourseController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\CourseController::class, 'store'])->name('store');
            Route::get('/{course}/edit', [\App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('edit');
            Route::get('/statistics', [\App\Http\Controllers\Admin\CourseController::class, 'statistics'])->name('statistics');
            Route::get('/logs', [\App\Http\Controllers\Admin\LogController::class, 'index'])->name('logs');
        });

        // Vérification des certificats
        Route::prefix('certificate-verifications')->name('certificates.verifications.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CertificateVerificationController::class, 'index'])->name('index');
            Route::get('/export', [\App\Http\Controllers\Admin\CertificateVerificationController::class, 'export'])->name('export');
        });

        // Logs des superviseurs
        Route::get('/supervisor-logs', [\App\Http\Controllers\Admin\SupervisorLogController::class, 'index'])->name('supervisor-logs');
    });
});

  /*
|--------------------------------------------------------------------------
| Authentification via Google
|--------------------------------------------------------------------------
*/
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/test-unique', function () {
    return 'UNIQUE_TEST_' . uniqid();
});

require __DIR__.'/auth.php';
