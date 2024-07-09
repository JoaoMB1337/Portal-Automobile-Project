<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckGoogle2FA
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !$user->google2fa_secret) {
            return redirect()->route('2fa.setup');
        }

        return $next($request);
    }
}
