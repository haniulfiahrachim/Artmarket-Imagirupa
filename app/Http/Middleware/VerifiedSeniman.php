<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedSeniman
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user->isSeniman() && !$user->isVerified()) {
            return redirect()->route('seniman.dashboard')
                ->with('warning', 'Akun seniman Anda belum diverifikasi. Silakan tunggu verifikasi dari admin.');
        }

        return $next($request);
    }
}
