@extends('components.master.main')

@section('content')
    <style>
        .dash{
            margin-top: 180px;
        }
    </style>
    <div class="dash mx-auto pl-10 lg:pl-64 ">
        <div class="container mx-auto">
            <div class="flex justify-center">
                <div class="w-full md:w-2/3 lg:w-1/2">
                    <div class="bg-white shadow-md rounded-lg px-8 py-6 mb-8">
                        <div class="mb-6 text-center">
                            <h2 class="text-3xl font-bold text-gray-800">Welcome to Your Dashboard</h2>
                            <p class="text-gray-600">Stay updated with your latest activities</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Widget: User Information -->
                            <div class="bg-blue-100 rounded-lg p-6 hover:shadow-xl transition duration-300">
                                <h3 class="text-xl font-semibold mb-4 text-blue-900">User Information</h3>
                                <div class="flex items-center mb-4">
                                    <div class="rounded-full bg-blue-500 text-white flex items-center justify-center h-12 w-12 mr-4">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-800 font-semibold">{{ Auth::user()->name }}</p>
                                        <p class="text-gray-600">{{ Auth::user()->email }}</p>
                                        <p class="text-gray-600">{{ Auth::user()->role->name }}</p>
                                        <p class="text-gray-600">{{ Auth::user()->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <a href="{{ url('employees/' . $employee->id) }}" class="text-blue-600 hover:underline">View Profile</a>
                            </div>

                            <!-- Widget: Recent Activity -->
                            <div class="bg-green-100 rounded-lg p-6 hover:shadow-xl transition duration-300">
                                <h3 class="text-xl font-semibold mb-4 text-green-900">Recent Activity</h3>
                                <ul class="text-gray-800">
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                        Activity 1
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                        Activity 2
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                        Activity 3
                                    </li>
                                </ul>
                                <a href="#" class="text-green-600 hover:underline">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
