@extends('layouts.app')

@section('content')
    <style>
        .custom-card {
            background-color: #ffffff;
            box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .form-input, .form-control {
            border: 2px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-control:focus {
            border-color: #888;
        }

        .custom-btn {
            background-color: #000;
            color: #fff;
            transition: background-color 0.3s ease;
            border-radius: 30px;
        }

        .custom-btn:hover {
            background-color: #222;
        }

        @media (max-width: 640px) {
            .custom-logo {
                width: 80px;
                height: 80px;
            }
        }
    </style>

    <div class="flex justify-center items-start h-screen bg-gray-200">
        <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
            <div class="card-header text-center font-bold">{{ __('Two Factor Authentication') }}</div>

            <div>
                <button>
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Back to Login</a>
                </button>
            </div>
            <div class="card-body">
                <p class="text-gray-700 text-sm mb-4">{{ __('Please enter your one-time password to complete your login.') }}</p>

                <form method="POST" action="{{ route('2fa.verify') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="one_time_password" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('One Time Password') }}</label>
                        <input id="one_time_password" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('one_time_password') border-red-500 @enderror" name="one_time_password" required autofocus>
                        @error('one_time_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="custom-btn py-2 px-4 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                            {{ __('Verify') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
