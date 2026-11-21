<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Jika belum login, arahkan ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // Jika role tidak sesuai, tolak akses
        if (! $user->hasRole(...$roles)) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }

        return $next($request);
    }
}
