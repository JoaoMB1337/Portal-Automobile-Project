@extends('layouts.app')

@section('content')

    <style>
        .custom-card {
            background-color: #ffffff;
            box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .custom-logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
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

        .form-input, .form-control {
            border: 2px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-control:focus {
            border-color: #888;
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
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-semibold text-gray-800">Two-Factor Authentication</h2>
            </div>
            <form method="POST" action="{{ route('2fa.verify') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="one_time_password" class="block text-sm font-semibold text-gray-700 mb-2">Coloque o codigo da aplicacao google auteticater</label>
                    <input type="text" name="one_time_password" id="one_time_password" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('one_time_password') border-red-500 @enderror" required>
                    @error('one_time_password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                        Verify
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
