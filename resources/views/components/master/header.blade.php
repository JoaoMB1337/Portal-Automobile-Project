<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])    @yield('styles')


<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="#" class="text-white font-bold">Innodrive</a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    @guest
                        <a href="{{ route('login') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        @endif
                    @else
                        <div class="ml-3 relative">
                            <div>
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out">
                                    <span class="sr-only">Open user menu</span>
                                    <span class="text-white">{{ Auth::user()->name }}</span>
                                </button>
                            </div>
                            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                                <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button class="text-white inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:bg-gray-700" aria-label="Main menu" aria-expanded="false">
                    <svg class="block h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    <svg class="hidden h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="text-white block px-3 py-2 rounded-md text-base font-medium">Players</a>
            <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium">ADD PLAYER</a>
            <a href="/" class="text-white block px-3 py-2 rounded-md text-base font-medium">EXPORT</a>
            @guest
                <a href="{{ route('login') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium">Register</a>
                @endif
            @else
                <a href="{{ route('logout') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            @endguest
        </div>
    </div>
</nav>
