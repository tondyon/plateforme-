<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateVerification;
use App\Models\User;
use App\Notifications\SuspiciousCertificateActivity;
use Illuminate\Http\Request;

class CertificateVerificationController extends Controller
{
    public function index()
    {
        $verifications = CertificateVerification::with(['course'])
            ->latest()
            ->paginate(20);

        // Grouper les vérifications par IP pour détecter les abus potentiels
        $suspiciousIPs = CertificateVerification::selectRaw('ip_address, COUNT(*) as count')
            ->whereDate('created_at', '>', now()->subDay())
            ->groupBy('ip_address')
            ->having('count', '>', 10)
            ->get();

        // Notifier les administrateurs des activités suspectes
        if ($suspiciousIPs->isNotEmpty()) {
            $admins = User::role('admin')->get();
            foreach ($suspiciousIPs as $ip) {
                foreach ($admins as $admin) {
                    $admin->notify(new SuspiciousCertificateActivity(
                        $ip->ip_address,
                        $ip->count
                    ));
                }
            }
        }

        return view('admin.certificates.verifications', compact('verifications', 'suspiciousIPs'));
    }

    public function export()
    {
        $verifications = CertificateVerification::with(['course'])
            ->latest()
            ->get();

        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['Date', 'Code', 'IP', 'User Agent', 'Status']);

        foreach ($verifications as $verification) {
            fputcsv($csv, [
                $verification->created_at->format('Y-m-d H:i:s'),
                $verification->verification_code,
                $verification->ip_address,
                $verification->user_agent,
                $verification->course ? 'Valid' : 'Invalid'
            ]);
        }

        rewind($csv);
        $content = stream_get_contents($csv);
        fclose($csv);

        $filename = 'certificate-verifications-' . now()->format('Y-m-d') . '.csv';

        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}