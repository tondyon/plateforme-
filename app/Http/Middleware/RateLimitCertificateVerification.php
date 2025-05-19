<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLimitCertificateVerification
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $key = 'certificate-verification:' . $request->ip();

        if ($this->limiter->tooManyAttempts($key, 10)) { // 10 tentatives max
            return response()->json([
                'error' => 'Trop de tentatives de vérification. Veuillez réessayer plus tard.',
                'retry_after' => $this->limiter->availableIn($key)
            ], 429);
        }

        $this->limiter->hit($key, 60 * 30); // Reset après 30 minutes

        return $next($request);
    }
}