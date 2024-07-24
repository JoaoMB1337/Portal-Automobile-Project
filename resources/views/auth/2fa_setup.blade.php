@extends('layouts.app')

@section('content')
    @vite('resources/css/2fa/2fa-setup.css')

    <div class="flex justify-center items-center min-h-screen">
        <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-6 shadow-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-semibold text-gray-800">Autenticação</h2>
                <p class="text-gray-600">Digitalize o código QR com seu aplicativo Google Authenticator ou insira a chave manualmente</p>
            </div>
            <div class="flex justify-center mb-6">
                {!! $qrCodeSvg !!}
            </div>
            <p class="text-center mb-6">Chave: <strong>{{ $secret }}</strong></p>
            <form method="POST" action="{{ route('2fa.completeSetup') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="secret" value="{{ $secret }}">

                <div>
                    <label for="one_time_password" class="block text-sm font-semibold text-gray-700 mb-2">Inserir chave</label>
                    <input type="text" name="one_time_password" id="one_time_password" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('one_time_password') border-red-500 @enderror" required>
                    @error('one_time_password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                        Verificar
                    </button>
                </div>
            </form>
            <div class="text-center mt-6">
                <p class="text-gray-600">Se você não possui o aplicativo Google Authenticator, pode baixá-lo nos links abaixo:</p>
                <div class="download-links">
                    <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" class="text-blue-500 underline" target="_blank">
                        <img src="https://www.svgrepo.com/show/475631/android-color.svg" alt="Android Icon"> Download para Android
                    </a>
                    <a href="https://apps.apple.com/app/google-authenticator/id388497605" class="text-blue-500 underline" target="_blank">
                        <img src="https://www.svgrepo.com/show/475633/apple-color.svg" alt="Apple Icon"> Download para iOS
                    </a>
                </div>
            </div>
        </div>
@endsection
