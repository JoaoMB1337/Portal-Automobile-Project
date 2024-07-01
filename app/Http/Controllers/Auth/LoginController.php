<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            ['employee_number' => $request->input('employee_number'), 'password' => $request->input('password')],
            $request->filled('remember')
        );
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'employee_number' => 'required',
            'password' => 'required',
        ]);

        if (! $this->guard()->attempt(['employee_number' => $request->input('employee_number'), 'password' => $request->input('password')], $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'employee_number' => [trans('auth.failed')],
            ]);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->google2fa_secret) {
            return redirect()->route('2fa.setup');
        }

        if ($user->uses_two_factor_auth) {
            $request->session()->put('2fa:user:id', $user->id);
            $request->session()->put('2fa:auth:remember', $request->has('remember'));
            return redirect()->route('2fa.verify');
        }

        return redirect()->intended($this->redirectPath());
    }
}
