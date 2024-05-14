@extends('components.master.main')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2 lg:w-1/3">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold">{{ __('You are logged in!') }}</h2>
                    </div>

                    <div class="text-gray-700">
                        @if (session('status'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('status') }}</span>
                            </div>
                        @endif

                            <p>
                                {{ __('Welcome') }}
                                <span class="font-bold">{{ Auth::user()->role->name }}</span>
                                <span class="font-bold">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->role)

                                @endif
                            </p>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
