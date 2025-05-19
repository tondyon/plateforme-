<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CertificateVerification;
use Illuminate\Support\Facades\Cache;

class CertificateVerificationStats extends Component
{
    public $totalVerifications;
    public $validVerifications;
    public $invalidVerifications;
    public $recentVerifications;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        // Cache the stats for 1 hour to improve performance
        $stats = Cache::remember('certificate-verification-stats', 3600, function () {
            return [
                'total' => CertificateVerification::count(),
                'valid' => CertificateVerification::whereHas('course')->count(),
                'invalid' => CertificateVerification::whereDoesntHave('course')->count(),
                'recent' => CertificateVerification::whereDate('created_at', '>', now()->subDays(7))
                    ->count()
            ];
        });

        $this->totalVerifications = $stats['total'];
        $this->validVerifications = $stats['valid'];
        $this->invalidVerifications = $stats['invalid'];
        $this->recentVerifications = $stats['recent'];
    }

    public function render()
    {
        return view('livewire.certificate-verification-stats');
    }
}