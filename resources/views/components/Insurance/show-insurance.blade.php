
    <div class="flex justify-center items-start h-screen custom-bg">
        <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
            <div class="flex justify-center mb-6">
                <h1>Insurance Details</h1>
            </div>

            <div class="mb-6">
                <div class="font-semibold">Insurance Company:</div>
                <div>{{ $insurance->insurance_company }}</div>
            </div>

            <div class="mb-6">
                <div class="font-semibold">Policy Number:</div>
                <div>{{ $insurance->policy_number }}</div>
            </div>

            <div class="mb-6">
                <div class="font-semibold">Start Date:</div>
                <div>{{ $insurance->start_date }}</div>
            </div>

            <div class="mb-6">
                <div class="font-semibold">End Date:</div>
                <div>{{ $insurance->end_date }}</div>
            </div>

            <div class="mb-6">
                <div class="font-semibold">Cost:</div>
                <div>{{ $insurance->cost }}</div>
            </div>

            <div class="mb-6">
                <div class="font-semibold">Vehicle Plate:</div>
                <div>{{ $insurance->vehicle-> plate }}</div>
            </div>

            <div class="mt-6 text-center text-sm text-gray-600">
                <a class="text-gray-800 hover:text-gray-700 font-semibold transition duration-300" href="{{ route('insurances.index') }}">
                    Back to Insurance List
                </a>
            </div>
        </div>
    </div>
