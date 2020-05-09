<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'لوحة تحكم') }}</title>
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
            body {direction: rtl;overflow-x: hidden;}
            *{font-family: Tajawal, sans-serif;transition: all .2s linear;}
        </style>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('dashboard.layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content ml-md-0">
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
        
<script>
    // This function set a cookie or change the cookie's value
    // code from w3schools.com
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    // Get the value of any set cookie
    // code from w3schools.com
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
        }
        return "";
    }

    // Open and Close Sidebar
    // This function set a cookie "sidebar_opened"
    // to check if the sidebar should be opened or closed
    function toggleSidebar() {
        $('.main-content').toggleClass('ml-md-0');
        $('nav.navbar.navbar-vertical').toggleClass('d-md-none');
        $('#sidenav-collapse-main').toggleClass('d-md-none');
        var cookie = getCookie("sidebar_opened");
        if (cookie == 'true') {
            setCookie('sidebar_opened', false, 365);
        } else {
            setCookie('sidebar_opened', true, 365);
        }
    }
    
    // The following block will open the sidebar or
    // close it depending on the cookie "sidebar_opened"
    var cookie = getCookie("sidebar_opened");
    if (cookie != "") {
        if (cookie == 'true') {            
            $('.main-content').removeClass('ml-md-0');
            $('nav.navbar.navbar-vertical').removeClass('d-md-none');
            $('#sidenav-collapse-main').removeClass('d-md-none');
        } else {
            $('.main-content').addClass('ml-md-0');
            $('nav.navbar.navbar-vertical').addClass('d-md-none');
            $('#sidenav-collapse-main').addClass('d-md-none');
        }
        // $('#sidenav-collapse-main').toggleClass('d-none');
    } else {
        setCookie('sidebar_opened', true, 365);
    }
</script>
    </body>
</html>