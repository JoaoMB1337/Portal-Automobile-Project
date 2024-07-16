<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventAccessTo2FA
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->google2fa_secret && $request->session()->has('2fa:user:id')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
