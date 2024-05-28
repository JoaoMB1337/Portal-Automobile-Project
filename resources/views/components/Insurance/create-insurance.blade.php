

    <div class="flex justify-center items-start h-screen custom-bg">
        <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
            <div class="flex justify-center mb-6">
                <h1>Insurance Register</h1>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('insurances.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="insurance_company" class="block text-sm font-semibold text-gray-700 mb-2">Insurance Company</label>
                    <input id="insurance_company" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('insurance_company') border-red-500 @enderror" name="insurance_company" value="{{ old('insurance_company') }}" required>
                    @error('insurance_company')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="policy_number" class="block text-sm font-semibold text-gray-700 mb-2">Policy Number</label>
                    <input id="policy_number" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('policy_number') border-red-500 @enderror" name="policy_number" value="{{ old('policy_number') }}" required>
                    @error('policy_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                    <input id="start_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('start_date') border-red-500 @enderror" name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                    <input id="end_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('end_date') border-red-500 @enderror" name="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Cost</label>
                    <input id="cost" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror" name="cost" value="{{ old('cost') }}" required>
                    @error('cost')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_plate" class="block text-sm font-semibold text-gray-700 mb-2">Plate</label>
                    <input id="vehicle_plate" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('vehicle_plate') border-red-500 @enderror" name="vehicle_plate" value="{{ old('vehicle_plate') }}" required>
                    @error('vehicle_plate')
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
                <a class="text-gray-800 hover:text-gray-700 font-semibold transition duration-300" href="{{ route('insurances.index') }}">
                    {{ __('Back to Insurance List') }}
                </a>
            </div>
        </div>
    </div>


