@extends('layouts.app')

@section('content')

    <style>
        .custom-bg {
            background-color: #f5f5f5;
        }

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

    <div class="flex justify-center items-start h-screen custom-bg">
        <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
            <div class="flex justify-center mb-6">
                <h1>Employee Register</h1>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                    <input id="name" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                    <select id="gender" class="form-control w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('gender') border-red-500 @enderror" name="gender" required>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input id="email" type="email" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password-confirm" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div>
                    <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">Birth Date</label>
                    <input id="birth_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('birth_date') border-red-500 @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="company_position" class="block text-sm font-semibold text-gray-700 mb-2">Company Position</label>
                    <input id="company_position" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('company_position') border-red-500 @enderror" name="company_position" value="{{ old('company_position') }}" required>
                    @error('company_position')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="driving_license_id" class="block text-sm font-semibold text-gray-700 mb-2">Driving License ID</label>
                    <input id="driving_license_id" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('driving_license_id') border-red-500 @enderror" name="driving_license_id" value="{{ old('driving_license_id') }}" required>
                    @error('driving_license_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="CC" class="block text-sm font-semibold text-gray-700 mb-2">CC</label>
                    <input id="CC" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('CC') border-red-500 @enderror" name="CC" value="{{ old('CC') }}" required>
                    @error('CC')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="NIF" class="block text-sm font-semibold text-gray-700 mb-2">NIF</label>
                    <input id="NIF" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('NIF') border-red-500 @enderror" name="NIF" value="{{ old('NIF') }}" required>
                    @error('NIF')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                    <input id="address" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('address') border-red-500 @enderror" name="address" value="{{ old('address') }}">
                    @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="mobile_number" class="block text-sm font-semibold text-gray-700 mb-2">Mobile Number</label>
                    <input id="mobile_number" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('mobile_number') border-red-500 @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required>
                    @error('mobile_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="employee_role_id" class="block text-sm font-semibold text-gray-700 mb-2">Employee Role</label>
                    <select id="employee_role_id" class="form-control w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('employee_role_id') border-red-500 @enderror" name="employee_role_id" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('employee_role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_role_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                <a class="text-gray-800 hover:text-gray-700 font-semibold transition duration-300" href="{{ route('login') }}">
                    {{ __('Already have an account? Login here') }}
                </a>
            </div>
        </div>
    </div>
@endsection
