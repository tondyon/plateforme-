<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsFormateur
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'formateur') {
            return $next($request);
        }
        abort(403, 'Accès réservé aux formateurs.');
    }
}
