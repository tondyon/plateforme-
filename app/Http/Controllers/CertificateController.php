<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CertificateVerification;
use App\Models\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class CertificateController extends Controller
{
    public function verify(Request $request, $code)
    {
        $enrollment = User::whereHas('enrolledCourses', function($query) use ($code) {
            $query->wherePivot('certificate_verification_code', $code);
        })
        ->with(['enrolledCourses' => function($query) use ($code) {
            $query->wherePivot('certificate_verification_code', $code);
        }])
        ->first();

        // Log the verification attempt
        CertificateVerification::create([
            'verification_code' => $code,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        if ($enrollment) {
            $enrollment = $enrollment->enrolledCourses->first();
        }

        return view('certificates.verification', compact('enrollment'));
    }

    public function downloadCertificate(Course $course)
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

        $pdf = PDF::loadView('certificates.course', $data);

        return $pdf->download("certificat-{$course->slug}-{$user->id}.pdf");
    }
}
