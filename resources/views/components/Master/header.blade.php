<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                width: 100vw;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            #sidebar a {
                font-size: 30px;
                padding: 10px 20px;
            }

            .content {
                margin-top: 64px;
            }

            .logo {
                width: 3rem;
                height: 3rem;
            }

            #mobile-menu-btn {
                visibility: visible;
                position: fixed;
                z-index: 2000;
            }
        }

        @media (max-width: 480px) {
            #sidebar a {
                font-size: 24px;
                padding: 8px 16px;
            }

            .content {
                margin-top: 56px;
            }

            .logo {
                width: 2.5rem;
                height: 2.5rem;
            }

            #mobile-menu-btn {
                left: 8px;
                top: 8px;
            }
        }

        .logo {
            width: 4rem;
            height: 4rem;
            background-color: white;
            border-radius: 50%;
            object-cover: cover;
            flex-shrink: 0;
        }

        #sidebar a:hover {
            background-color: #4a5568;
        }

        nav#sidebar {
            display: flex;
            flex-direction: column;
            height: 100vh;
            z-index: 999;
        }

        header {
            z-index: 1000;
            position: relative;
        }

        #mobile-menu-btn {
            background-color: #333;
            border: 2px solid #fff;
            color: #fff;
            padding: 8px;
            border-radius: 10%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            position: fixed;
            top: 10px;
            left: 10px;
        }

        #mobile-menu-btn svg {
            fill: #fff;
        }

        #mobile-menu-btn.right {
            left: auto;
            right: 10px;
        }

        .custom-container {
            margin-top: 40px;
        }

        @media (max-width: 820px) {
            #sidebar {
                transform: translateX(-100%);
                width: 100vw;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            #sidebar a {
                font-size: 28px;
                padding: 9px 18px;
            }

            .logo {
                width: 2.75rem;
                height: 2.75rem;
            }

            #mobile-menu-btn {
                visibility: visible;
                position: fixed;
                z-index: 2000;
                left: 10px;
                top: 10px;
            }
        }

        @media (max-width: 912px) {
            #sidebar {
                transform: translateX(-100%);
                width: 100vw;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            #sidebar a {
                font-size: 28px;
                padding: 9px 18px;
            }

            .content {
                margin-top: 60px;
            }

            .logo {
                width: 3rem;
                height: 3rem;
            }

            #mobile-menu-btn {
                visibility: visible;
                position: fixed;
                z-index: 2000;
                left: 10px;
                top: 10px;
            }
        }

        .relative {
            position: relative;
        }

        .show {
            display: block !important;
        }

        #sidebar a:hover {
            background-color: #3c4350;
        }

        #trips-submenu,
        #vehicles-submenu,
        #reports-submenu {
            display: none;
            z-index: 1000;
        }

        nav#sidebar {
            display: flex;
            flex-direction: column;
            height: 100vh; 
            z-index: 999;
        }

        .overflow-y-auto {
            flex-grow: 1;
            overflow-y: auto;
        }

        .mt-auto {
            margin-top: auto;
        }

        @media (max-width: 1025px) {
            #sidebar {
                transform: translateX(-100%);
                width: 100vw;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            #sidebar a {
                font-size: 32px;
                padding: 10px 20px;
            }

            .content {
                margin-top: 64px;
            }

            .logo {
                width: 3.5rem;
                height: 3.5rem;
            }

            #mobile-menu-btn {
                visibility: visible;
                position: fixed;
                z-index: 2000;
            }
        }

        @media (max-width: 992px) {
            #sidebar {
                transform: translateX(-100%);
                width: 100vw;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            #sidebar a {
                font-size: 30px;
                padding: 10px 20px;
            }

            .content {
                margin-top: 64px;
            }

            .logo {
                width: 3rem;
                height: 3rem;
            }

            #mobile-menu-btn {
                visibility: visible;
                position: fixed;
                z-index: 2000;
            }
        }
    </style>
</head>
<body>
<nav id="sidebar" class="bg-gray-800 h-full fixed w-64 top-0 left-0 flex flex-col md:w-56 lg:w-64 transition-all duration-300 ease-in-out transform -translate-x-full md:translate-x-0">
    <div class="custom-container px-4 py-8 border-b border-gray-700 flex items-center">
        <div class="mt-5 h-15 bg-white rounded-full flex-shrink-0 mr-2 logo">
            <img src="{{ asset('images/App-logo.png') }}" alt="Logo" class="w-full h-full object-cover rounded-full logo ">
        </div>
        <a href="/home" class="mt-5 text-white text-xl font-bold">InnoDrive</a>
    </div>

    <div class="overflow-y-auto flex-1">
        <ul class="py-4">
            @if(Auth::check() && Auth::user()->isMaster())
                <li>
                    <a href="/home" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Home</a>
                </li>
                <li>
                    <a href="/employees" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Funcionarios</a>
                </li>
            @endif

            <li class="relative">
                <a href="#" id="trips-menu" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200 relative flex items-center">
                    Viagens
                    <svg class="w-4 h-4 ml-1 arrow-down inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <ul id="trips-submenu" class="bg-gray-600 text-white w-full mt-1 hidden">
                    <li>
                        <a href="/trips" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200 ">Ver Viagem</a>
                    </li>
                    <li>
                        <a href="/projects" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Ver Projetos</a>
                    </li>
                </ul>
            </li>
            @if(Auth::check() && Auth::user()->isMaster())
            <li class="relative">
                <a href="#" id="vehicles-menu" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200 relative flex items-center">
                    Veículos
                    <svg class="w-4 h-4 ml-1 arrow-down inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <ul id="vehicles-submenu" class="bg-gray-600 text-white w-full mt-1 hidden">
                    <li>
                        <a href="/vehicles" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Ver Veículos</a>
                    </li>
                    <li>
                        <a href="/insurances" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Ver Seguros</a>
                    </li>
                </ul>
            </li>
            @endif

            @if(Auth::check() && Auth::user()->isMaster())
                <li class="relative">
                    <a href="#" id="reports-menu" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200 relative flex items-center">
                        Relatórios
                        <svg class="w-4 h-4 ml-1 arrow-down inline-block " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>

                    <ul id="reports-submenu" class="bg-gray-600 text-white w-full mt-1 hidden">
                        <li>
                            <a href="/cost-report" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Relatórios Viagens</a>
                        </li>
                        <li>
                            <a href="/external-car-report" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Relatórios Veículos</a>
                        </li>
                        <li>
                            <a href="/project-reports" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Relatórios Projetos</a>
                        </li>
                        <li>
                            <a href="/insurance-reports" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Relatórios Seguros</a>
                        </li>
                    </ul>
                </li>

            @endif

        </ul>
    </div>

    <div class="mt-auto">
        @guest
            <div class="px-4 py-3 border-t border-gray-700">
                <a href="{{ route('login') }}" class="auth-link block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="auth-link block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Register</a>
                @endif
            </div>
        @else
            <div class="relative px-4 py-3 border-t border-gray-700">
                <div class="flex items-center">
                    <span class="text-white">{{ Auth::user()->name }}</span>
                    <button id="user-menu-btn" class="user-menu-btn ml-auto focus:outline-none">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM2 10a8 8 0 1116 0 8 8 0 01-16 0z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M5 9a1 1 0 011-1h8a1 1 0 010 2H6a1 1 0 01-1-1zm3-4a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden bottom-12">
                    <div class="py-1">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="block px-4 py-2 text-gray-800 hover:bg-gray-300 transition-colors duration-200">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</nav>

<button id="mobile-menu-btn" class="fixed top-4 left-4 z-50 text-white p-2 ml-4 rounded focus:outline-none">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M3 5h14a1 1 0 100-2H3a1 1 0 000 2zm0 6h14a1 1 0 100-2H3a1 1 0 000 2zm0 6h14a1 1 0 100-2H3a1 1 0 000 2z" clip-rule="evenodd"></path>
    </svg>
</button>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const body = document.querySelector('body');
        sidebar.classList.toggle('show');
        body.classList.toggle('body-shift');
    });

    document.getElementById('user-menu-btn').addEventListener('click', function() {
        document.getElementById('user-dropdown').classList.toggle('hidden');
    });

    document.getElementById('user-menu-btn').addEventListener('mouseenter', function() {
        document.getElementById('user-dropdown').classList.remove('hidden');
    });

    document.getElementById('user-dropdown').addEventListener('mouseleave', function() {
        document.getElementById('user-dropdown').classList.add('hidden');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const tripsMenu = document.getElementById('trips-menu');
        const tripsSubMenu = document.getElementById('trips-submenu');
        const vehiclesMenu = document.getElementById('vehicles-menu');
        const vehiclesSubMenu = document.getElementById('vehicles-submenu');
        const reportsMenu = document.getElementById('reports-menu');
        const reportsSubMenu = document.getElementById('reports-submenu');

        tripsMenu.addEventListener('click', function(e) {
            e.preventDefault();
            tripsSubMenu.classList.toggle('show');
        });

        vehiclesMenu.addEventListener('click', function(e) {
            e.preventDefault();
            vehiclesSubMenu.classList.toggle('show');
        });

        reportsMenu.addEventListener('click', function(e) {
            e.preventDefault();
            reportsSubMenu.classList.toggle('show');
        });
    });
</script>
</body>
</html>
