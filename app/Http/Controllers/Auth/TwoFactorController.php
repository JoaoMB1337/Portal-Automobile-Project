<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class TwoFactorController extends Controller
{
    // Função para exibir a página de configuração do 2FA
    public function setup(Request $request)
    {
        $google2fa = new Google2FA();
        $user = auth()->user();
        $secret = $google2fa->generateSecretKey();
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('auth.2fa_setup', [
            'secret' => $secret,
            'qrCodeUrl' => $qrCodeUrl
        ]);
    }

    // Função para completar a configuração do 2FA
    public function completeSetup(Request $request)
    {
        $request->validate(['secret' => 'required|string']);
        $user = auth()->user();
        $user->google2fa_secret = $request->input('secret');
        $user->uses_two_factor_auth = true;
        $user->save();

        return redirect()->route('home')->with('success', '2FA setup complete.');
    }

    // Função para exibir o formulário de verificação do 2FA
    public function showVerifyForm()
    {
        return view('auth.2fa_verify');
    }

    // Função para verificar o código 2FA
    public function verify(Request $request)
    {
        $request->validate(['one_time_password' => 'required|string']);

        $user_id = $request->session()->get('2fa:user:id');
        $remember = $request->session()->get('2fa:auth:remember', false);
        $attempt = $request->session()->get('2fa:auth:attempt', false);

        if (!$user_id || !$attempt) {
            return redirect()->route('login');
        }

        $user = User::find($user_id);

        if (!$user || !$user->uses_two_factor_auth) {
            return redirect()->route('login');
        }

        $google2fa = new Google2FA();
        $otp_secret = $user->google2fa_secret;

        if (!$google2fa->verifyKey($otp_secret, $request->one_time_password)) {
            throw ValidationException::withMessages([
                'one_time_password' => [__('The one time password is invalid.')],
            ]);
        }

        Auth::login($user, $remember);

        $request->session()->forget(['2fa:user:id', '2fa:auth:remember', '2fa:auth:attempt']);

        return redirect()->intended('/');
    }
}
