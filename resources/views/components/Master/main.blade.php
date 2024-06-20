<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>Project</title>

    {{-- STYLE SECTION --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    @yield('styles')
    {{-- .STYLE SECTION --}}

</head>
<body class="bg-gray-300">


{{-- HEADER SECTION --}}
<header class=" text-white ">

        @component('components.Master.header')
        @endcomponent
</header>
{{-- .HEADER SECTION --}}


{{-- CONTENT SECTION --}}
<main class="container mx-auto px-4 py-8 ">
    @yield('content')
</main>
{{-- .CONTENT SECTION --}}


{{-- FOOTER SECTION
<footer class="bg-light text-center text-sm text-gray-600 py-4">
    <div class="container mx-auto px-4">
        @component('components.Master.footer')
        @endcomponent
    </div>
</footer>--}}
{{-- .FOOTER SECTION --}}


{{-- SCRIPTS SECTION--}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>
@yield('scripts')
{{-- .SCRIPTS SECTION--}}
</body>
</html>
