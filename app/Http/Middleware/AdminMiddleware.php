<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
          // Vérifie si l'utilisateur est authentifié ET est admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirige vers la home page si non autorisé
        return redirect('/')->with('error', 'Accès non autorisé');
    }
}
