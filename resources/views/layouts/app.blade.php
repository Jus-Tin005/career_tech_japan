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
    <link rel="stylesheet" href="{{ asset('assets/css/global_style.css') }}">

   @yield('css')
</head>

<body>

    {{-- Begin:Wrapper --}}
    <div class="wrapper">

        {{-- Page Loader --}}
        <div id="page-loader" class="loader">
            <div class="spinner"></div>
        </div>

        {{-- Begin:Navbar Wrapper --}}
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">


                {{-- Logo --}}
                <a class="sidebar-brand" href="{{ route('dashboard') }}">
                    <span class="align-middle">{{ config('app.name') }}</span>
                    <hr>
                </a>




                {{-- Begin:Sidebar Inner --}}
                @include('layouts.partials.sidebar')
                {{-- End:Sidebar Inner --}}

            </div>
        </nav>
        {{-- End:Navbar Wrapper --}}


        {{-- Begin:Main Content --}}
        <div class="main">

                {{-- Begin:Top Navbar --}}
                @include('layouts.partials.navbar')
                {{-- End:Top Navbar --}}

                <main class="content">
                    <div class="container-fluid p-0">

                        @yield('content')

                    </div>
                </main>



                {{-- Begin:Footer --}}
                @include('layouts.partials.footer')
                {{-- End:Footer --}}
        </div>
        {{-- End:Main Content --}}
    </div>
    {{-- End:Wrapper --}}



    {{--Scroll to Top Button --}}
    <button id="scroll-to-top" class="scroll-to-top">
        &#8679;
    </button>


    <script src="{{ asset('assets/libs/jquery-3.7.1.min.js') }}"></script>

    {{-- Main Scripts --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/global_functions.js') }}"></script>


    <script src="{{ asset('assets/libs/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.validate.min.js') }}"></script>


    @yield('script')



    {{-- Begin:Sweet Alert2 --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    {{-- End:Sweet Alert2 --}}




</body>

</html>
