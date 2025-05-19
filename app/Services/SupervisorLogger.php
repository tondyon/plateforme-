<?php

namespace App\Services;

use App\Models\SupervisorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorLogger
{
    public static function log(string $action, array $details = [], ?Request $request = null): void
    {
        SupervisorLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'details' => $details,
            'ip_address' => $request?->ip()
        ]);
    }
}
