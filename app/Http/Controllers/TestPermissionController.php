<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestPermissionController extends Controller
{
    public function checkSupervisorPermissions()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        return response()->json([
            'is_supervisor' => $user->isSupervisor(),
            'permissions' => $user->permissions,
            'can_view_statistics' => $user->hasPermission('view_statistics'),
            'can_export_data' => $user->hasPermission('export_data')
        ]);
    }
}
