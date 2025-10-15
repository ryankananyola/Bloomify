<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FloristMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'florist') {
            return redirect()->route('dashboard_user')
                ->with('error', 'Akses ditolak. Hanya florist yang bisa ke sini.');
        }

        return $next($request);
    }
}
