<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

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
        Log::info('Attempting login for employee_number: ' . $request->input('employee_number'));

        $attempt = $this->guard()->attempt(
            ['employee_number' => $request->input('employee_number'), 'password' => $request->input('password')],
            $request->filled('remember')
        );

        Log::info('Login attempt ' . ($attempt ? 'successful' : 'failed') . ' for employee_number: ' . $request->input('employee_number'));

        return $attempt;
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

        Log::info('Validating login for employee_number: ' . $request->input('employee_number'));

        if (!$this->guard()->attempt(['employee_number' => $request->input('employee_number'), 'password' => $request->input('password')], $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'employee_number' => [trans('auth.failed')],
            ]);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        Log::info('User authenticated: ' . $user->employee_number);

        if (!$user->google2fa_secret) {
            Log::info('Redirecting to 2FA setup for user: ' . $user->employee_number);
            return redirect()->route('2fa.setup');
        }

        if ($user->uses_two_factor_auth) {
            Log::info('Redirecting to 2FA verification for user: ' . $user->employee_number);
            $request->session()->put('2fa:user:id', $user->id);
            $request->session()->put('2fa:auth:remember', $request->has('remember'));
            return redirect()->route('2fa.verifyForm');
        }

        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
