<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Para onde redirecionar usuários após o login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Cria uma nova instância do controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Obtém o guard a ser usado durante a autenticação.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard('web');
    }

    /**
     * Sobrescreve o método username para usar o campo email.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
