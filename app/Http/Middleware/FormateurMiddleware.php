<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté et a le rôle "formateur"
        $user = Auth::user();
        if (!$user || !$user->hasRole('formateur')) {
            abort(403, 'Accès réservé aux formateurs.');
        }
        return $next($request);
    }
}
