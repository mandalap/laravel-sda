<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FavIcon -->
    <link rel="icon" href="{{ asset('new/assets/images/icons/logo.svg') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('includes.style')
</head>

<body>
    <div id="Content-Container"
        class="relative flex flex-col w-full max-w-[640px] min-h-screen mx-auto bg-white overflow-x-hidden">

        @yield('content')

        @include('sweetalert::alert')

    </div>

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>


</html>
