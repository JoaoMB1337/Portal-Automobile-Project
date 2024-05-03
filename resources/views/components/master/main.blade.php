
<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Project</title>

    {{-- STYLE SECTION --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])    @yield('styles')
    {{-- .STYLE SECTION --}}

</head>
<body>


{{-- HEADER SECTION --}}
@component('components.master.header')
@endcomponent
{{-- .HEADER SECTION --}}


{{-- CONTENT SECTION --}}
<main>
    @yield('content')
</main>
{{-- .CONTENT SECTION --}}



{{-- FOOTER SECTION --}}
@component('components.master.footer')
@endcomponent
{{-- .FOOTER SECTION --}}



{{-- SCRIPTS SECTION--}}
<script src="{!!asset('js/app.js')!!}" type="text/javascript"></script>
@yield('scripts')
{{-- .SCRIPTS SECTION--}}</body>
</html>
