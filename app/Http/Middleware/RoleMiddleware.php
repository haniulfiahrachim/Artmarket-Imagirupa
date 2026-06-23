<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Seniman harus verified untuk akses penuh
        if ($user->isSeniman() && !$user->isVerified() && !$request->routeIs('seniman.dashboard')) {
            return redirect()->route('seniman.dashboard')
                ->with('warning', 'Akun Anda belum diverifikasi oleh admin.');
        }

        return $next($request);
    }
}
