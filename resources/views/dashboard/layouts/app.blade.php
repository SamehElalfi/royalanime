<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'لوحة تحكم') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('favicon.webp') }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('argon/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
        <link href="{{ asset('argon/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon/css/argon.css?v=1.0.0') }}" rel="stylesheet">
        <style>
            .bg-fire {background-image: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(255,72,0,1) 100%);}
            body {direction: rtl;}
            *{font-family: Tajawal, sans-serif;}
        </style>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('dashboard.layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('dashboard.layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('dashboard.layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon/js/argon.js?v=1.0.0') }}"></script>
    </body>
</html>