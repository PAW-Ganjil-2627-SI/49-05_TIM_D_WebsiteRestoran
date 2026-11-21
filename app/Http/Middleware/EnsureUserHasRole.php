<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = $request->user();

        // 1. Belum login? Arahkan ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // 2. Sudah login, tapi peran tidak sesuai? Tolak
        if (! $user->hasRole(...$roles)) {
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        // 3. Lolos: lanjut ke controller
        return $next($request);
    }
}
