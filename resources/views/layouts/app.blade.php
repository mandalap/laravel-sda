<!doctype html>
<html lang="">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('includes.style')
</head>

<body>
    <div id="Content-Container" class="relative flex flex-col w-full max-w-[640px] min-h-screen mx-auto bg-white overflow-x-hidden">

        @yield('content')


    </div>

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>


</html>
