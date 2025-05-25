<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    Auth\GoogleController,
    RoleController,
    CategoryController,
    CertificationController
};
use App\Http\Controllers\Admin\{
    CourseController as AdminCourseController,
    CertificateVerificationController,
    LogController,
    SupervisorLogController,
    DiplomeController
};
use App\Http\Controllers\Admin\DiplomeController as AdminDiplomeController;
use App\Http\Controllers\FormateurCourseController;
use App\Http\Controllers\Supervisor\ExportController;
use App\Http\Controllers\DiplomeFrontController;

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

// Vérification certificat publique
Route::get('/verify-certificate/{code}', [CertificateController::class, 'verify'])
    ->name('certificates.verify')
    ->middleware('rate.limit.certificates');

// Authentification Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route de test
Route::get('/test-unique', fn() => 'UNIQUE_TEST_' . uniqid());

/*
|--------------------------------------------------------------------------
| Routes Authentifiées
|--------------------------------------------------------------------------
*/
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Le lien de vérification a été envoyé !');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contact
    Route::get('/contact', [ContactController::class, 'create'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    // Profil
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

    // Test permissions
    Route::get('/test-permissions', [TestPermissionController::class, 'checkSupervisorPermissions']);

    /*
    |--------------------------------------------------------------------------
    | Routes Formateur
    |--------------------------------------------------------------------------
    */
    Route::prefix('formateur')->name('formateur.')->group(function () {
        Route::get('/dashboard', [FormateurDashboardController::class, 'index'])->name('dashboard');

        // Courses
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', [FormateurCourseController::class, 'index'])->name('index');
            Route::get('/create', [FormateurCourseController::class, 'create'])->name('create');
            Route::get('/{course}/edit', [FormateurCourseController::class, 'edit'])->name('edit');
            Route::delete('/{course}', [FormateurCourseController::class, 'destroy'])->name('destroy');

            // Fichiers
            Route::prefix('files')->name('files.')->group(function () {
                Route::get('/', [CourseFileController::class, 'index'])->name('index');
                Route::get('/create', [CourseFileController::class, 'create'])->name('create');
                Route::post('/', [CourseFileController::class, 'store'])->name('store');
                Route::get('/{file}', [CourseFileController::class, 'show'])->name('show');
                Route::delete('/{file}', [CourseFileController::class, 'destroy'])->name('destroy');
            });
        });

        // Réunions
        Route::prefix('meetings')->name('meetings.')->group(function () {
            Route::get('/', [MeetingController::class, 'index'])->name('index');
        });

        // Directs
        Route::prefix('directs')->name('directs.')->group(function () {
            Route::get('/', [DirectController::class, 'index'])->name('index');
        });
        Route::prefix('meetings')->name('meetings.')->group(function () {
            Route::get('/', [MeetingController::class, 'index'])->name('index');
            Route::get('/create', [MeetingController::class, 'create'])->name('create');
            Route::post('/', [MeetingController::class, 'store'])->name('store');
            Route::get('/{meeting}', [MeetingController::class, 'show'])->name('show');
            Route::get('/{meeting}/edit', [MeetingController::class, 'edit'])->name('edit');
            Route::put('/{meeting}', [MeetingController::class, 'update'])->name('update');
            Route::delete('/{meeting}', [MeetingController::class, 'destroy'])->name('destroy');
        });

        // Directs
        Route::prefix('direct')->name('direct.')->group(function () {
            Route::get('/', fn() => view('formateur.meetings.direct', ['jitsiUrl' => 'https://meet.jit.si/' . uniqid('direct_')]))->name('index');
            Route::get('/create', [DirectController::class, 'create'])->name('create');
            Route::post('/', [DirectController::class, 'store'])->name('store');
            Route::get('/{direct}', [DirectController::class, 'show'])->name('show');
        });
    });

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
        Route::get('/export-courses', [ExportController::class, 'exportCourses'])->name('export-courses');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes Admin
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->middleware('can:admin')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', [AdminCourseController::class, 'index'])->name('index');
            Route::get('/create', [AdminCourseController::class, 'create'])->name('create');
            Route::post('/', [AdminCourseController::class, 'store'])->name('store');
            Route::get('/{course}/edit', [AdminCourseController::class, 'edit'])->name('edit');
            Route::get('/statistics', [AdminCourseController::class, 'statistics'])->name('statistics');
            Route::get('/logs', [LogController::class, 'index'])->name('logs');
        });

        Route::prefix('certificate-verifications')->name('certificates.verifications.')->group(function () {
            Route::get('/', [CertificateVerificationController::class, 'index'])->name('index');
            Route::get('/export', [CertificateVerificationController::class, 'export'])->name('export');
        });

        Route::get('/supervisor-logs', [SupervisorLogController::class, 'index'])->name('supervisor-logs');
        Route::get('/admin/diplomes', [AdminDiplomeController::class, 'index']);


    });
});

/*
|--------------------------------------------------------------------------
| Routes Générales Supplémentaires
|--------------------------------------------------------------------------
*/
Route::prefix('roles')->name('roles.')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/{role}', [RoleController::class, 'show'])->name('show');
});

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
});

Route::prefix('certifications')->name('certifications.')->group(function () {
    Route::get('/', [CertificationController::class, 'index'])->name('index');

    Route::get('/diplomes', [DiplomeFrontController::class, 'index'])->name('diplomes.index');

});

// Correction temporaire de l'erreur Route [cart] not defined
Route::get('/cart', function () {
    return view('cart'); // Créez resources/views/cart.blade.php si besoin
})->name('cart');

// Correction temporaire de l'erreur Route [notifications] not defined
Route::get('/notifications', function () {
    return view('notifications'); // Créez resources/views/notifications.blade.php si besoin
})->name('notifications');

// Correction temporaire de l'erreur Route [profile] not defined
Route::get('/profile', function () {
    return view('profile.show'); // Utilise resources/views/profile/show.blade.php
})->name('profile');

// Correction temporaire de l'erreur Route [profile.edit] not defined
Route::get('/profile/edit', function () {
    return view('profile.edit'); // Utilise resources/views/profile/edit.blade.php
})->name('profile.edit');

// Routes RESTful pour la gestion des certificats
Route::resource('certificates', App\Http\Controllers\CertificationController::class);

// Correction temporaire de l'erreur Route [settings] not defined
Route::get('/settings', function () {
    return view('settings'); // Créez resources/views/settings.blade.php si besoin
})->name('settings');

require __DIR__.'/auth.php';
