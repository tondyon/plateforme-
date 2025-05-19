<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CertificateVerification;
use Carbon\Carbon;

class CleanupCertificateVerifications extends Command
{
    protected $signature = 'certificates:cleanup {--days=90}';
    protected $description = 'Clean up old certificate verification records';

    public function handle()
    {
        $days = $this->option('days');
        $date = Carbon::now()->subDays($days);

        $count = CertificateVerification::where('created_at', '<', $date)->delete();

        $this->info("Supprimé {$count} anciennes vérifications de certificats.");
    }
}