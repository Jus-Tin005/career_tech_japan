<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('address_title')</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Mian CSS & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @yield('css')
</head>

<body>

            {{-- Begin:Main Content --}}
            <main class="d-flex w-100">
                <div class="container d-flex flex-column">
                    @yield('auth_content')
                </div>
            </main>
            {{-- End:Main Content --}}


    {{-- Main Scripts --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('script')







</body>

</html>
