<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloristMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form');
        }

        if ($user->role === 'florist') {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses sebagai florist.');
    }
}
