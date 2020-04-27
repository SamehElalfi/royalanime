<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ isset($description) ? $description . ' - شاهد الآلاف من مسلسلات وأفلام الأنمي مجانًا وبروابط مباشرة وبدون إعلانات مزعجة.' : 'شاهد الآلاف من مسلسلات وأفلام الأنمي مجانًا وبروابط مباشرة وبدون إعلانات مزعجة.' }}">
    <meta name="author" content="Sameh Elalfi">

    <title>{{ isset($title) ? $title . ' - رويال أنمي' : 'رويال أنمي' }}</title>

    <!-- Favicon -->
    <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="{{ asset('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet"> --}}
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @hasSection ('style')
        <style>
            \@yield('style')
        </style>
    @endif
</head>
<body>

    <header class="header-global {{ isset($primary_nav) ? ($primary_nav ? 'bg-primary' : '') : ''}} mb-5">

        {{-- Include Navbar --}}
        @include('layouts.nav')

        {{-- Include Header Details --}}
        @hasSection ('header')
            @yield('header')
        @endif

    </header>

    @yield('content')

    @include('layouts.footer')

    <!-- JS -->
    <script src='{{ asset('js/jquery.min.js') }}'></script>
    <script src='{{ asset('js/app.js') }}'></script>

    <!-- Blog Posts Swiper -->
    <script>
        var swiper = new Swiper('.blog-slider', {
            spaceBetween: 30,
            effect: 'fade',
            loop: true,
            mousewheel: {
            invert: false,
            },
            pagination: {
            el: '.blog-slider__pagination',
            clickable: true,
            }
        });
        var swiper = new Swiper('.swiper-container-a', {
            slidesPerView: 4,
            spaceBetween: 30,
            centeredSlides: true,
            freeMode: true,
            pagination: {
            el: '.swiper-pagination-a',
            clickable: true,
            },
            navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            },
        });
    </script>

    {{-- <!-- Search Button and Search Field -->
    <script>
        function classToggle() {
            document.querySelector('#searchfield').classList.toggle('d-lg-none');
            document.querySelector('#searchbtn').classList.toggle('d-lg-block');
        }
        document.querySelector('#searchfield').addEventListener('focusout', classToggle);
        document.querySelector('#searchbtn').addEventListener('click', classToggle);
    </script> --}}
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-164705179-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-164705179-1');
</script>
    @hasSection ('scripts')
        <script>
            @yield('scripts')
        </script>
    @endif
</body>
</html>
