<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckValid2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e se o 2FA está configurado
        if (Auth::check()) {
            $user = Auth::user();
            // Suponha que 'is_2fa_valid' é um campo na sessão que indica uma 2FA bem-sucedida
            if (!$request->session()->get('is_2fa_valid', false)) {
                return redirect()->route('2fa.verify');
            }
        }

        return $next($request);
    }
}
