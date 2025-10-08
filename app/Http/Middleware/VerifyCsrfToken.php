<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Daftar URI yang harus diabaikan CSRF verification-nya.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Tambahkan route API di sini jika tidak perlu CSRF
        'api/*',
    ];
}
