<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupervisorLog;
use Illuminate\Http\Request;

class SupervisorLogController extends Controller
{
    public function index()
    {
        $logs = SupervisorLog::with('user')->latest()->paginate(20);
        return view('admin.supervisor-logs', compact('logs'));
    }

    /**
     * Export supervisor logs as CSV or JSON, respecting filters.
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        $query = SupervisorLog::with('user');
        if ($date = $request->get('date')) {
            $query->whereDate('created_at', $date);
        }
        if ($user = $request->get('superviseur')) {
            $query->whereHas('user', function($q) use ($user) {
                $q->where('name', 'like', "%{$user}%");
            });
        }
        if ($action = $request->get('action')) {
            $query->where('action', 'like', "%{$action}%");
        }
        $logs = $query->latest()->get();
        if ($format === 'json') {
            return response()->json($logs)
                ->header('Content-Disposition', 'attachment; filename="supervisor-logs.json"');
        }
        // Générer CSV
        $csv = "Date,Superviseur,Action,Details,IP\n";
        foreach ($logs as $log) {
            $details = $log->details ? json_encode($log->details, JSON_UNESCAPED_UNICODE) : '';
            $csv .= "{$log->created_at},{$log->user->name},{$log->action},{$details},{$log->ip_address}\n";
        }
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="supervisor-logs.csv"'
        ]);
    }
}
