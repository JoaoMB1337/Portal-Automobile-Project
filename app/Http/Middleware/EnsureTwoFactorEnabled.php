<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureTwoFactorEnabled
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && (!$user->uses_two_factor_auth || !$request->session()->has('2fa:user:id'))) {
            return redirect()->route('2fa.verify');
        }

        return $next($request);
    }
}
