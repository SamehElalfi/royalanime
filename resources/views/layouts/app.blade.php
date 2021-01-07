<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ isset($description) ? $description . ' - شاهد الآلاف من مسلسلات وأفلام الأنمي مجانًا وبروابط مباشرة وبدون إعلانات مزعجة.' : 'شاهد الآلاف من مسلسلات وأفلام الأنمي مجانًا وبروابط مباشرة وبدون إعلانات مزعجة.' }}">
    <meta name="keywords" content="{{ isset($keywords) ? $keywords : 'أنمي مترجم, أنمي أونلاين, أنمي أون لاين, رويال أنمي, أنمي رويال, موقع رويال أنمي, رويال أنمي أكبر موقع أنمي' }}">
    
    @isset($canonical)
        <link rel="canonical" href="{{ $canonical ?? '' }}" />
    @endisset
    
    <meta name="author" content="Sameh Elalfi">

    @isset($full_title)
        <title>{{ $full_title }}</title>
    @else
        <title>{{ $title ?? "رويال أنمي - أكبر موقع أنمي على الإطلاق" }}</title>
    @endisset
    
    <link rel="apple-touch-icon" href="{{ cdn('img/brand/white.webp') }}">
    <meta property=”fb:pages” content=”RoyalAnimeOfficial”/>
    <meta property="og:title" content="رويال أنمي - أكبر موقع أنمي على الإطلاق">
    <meta property="og:description" content="شاهد الآلاف من مسلسلات وأفلام الأنمي مجانًا وبروابط مباشرة وبدون إعلانات مزعجة.">
    <meta property="og:image" content="{{ cdn('img/brand/white.webp') }}">
    <meta property="og:url" content="https://www.royalanime.com">
    
    <meta name="twitter:site" content="@RoyalAnimeCom">
    <meta name="twitter:description" content="شاهد الآلاف من مسلسلات وأفلام الأنمي مجانًا وبروابط مباشرة وبدون إعلانات مزعجة.' : 'شاهد الآلاف من مسلسلات وأفلام الأنمي مجانًا وبروابط مباشرة وبدون إعلانات مزعجة.">
    <meta name="twitter:title" content="رويال أنمي - أكبر موقع أنمي على الإطلاق">
    <meta name="twitter:image" content="{{ cdn('img/brand/white.webp') }}">
    <meta name="twitter:card" content="{{ cdn('img/brand/white.webp') }}">
    <meta name="twitter:image:alt" content="رويال أنمي - أكبر موقع أنمي على الإطلاق">

    <meta property="og:site_name" content="رويال أنمي - أكبر موقع أنمي على الإطلاق">

    <!-- Favicon -->
    <link href="{{ cdn('favicon.webp') }}" rel="icon" type="image/png">

    <!-- Fonts -->
    {{-- <link href="{{ cdn('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet"> --}}
    <link href="{{ cdn('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ cdn('css/app.css') }}">
    <style>
        .colored-bg-transparent{background-image:linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));}
        .colored-bg{background-image:linear-gradient(rgba(94, 114, 228, 0.3), rgba(23, 43, 77, 0.3));}
        .colored-bg-dark {background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(20,0,100,0.8));}
        /* .h-400{height:400px;} */
        .tab-pane{
            position: relative;
            width: 100%;
            padding-top: 56.25%;
        }
        .tab-pane iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            height: 100%;
        }
        .cursor-pointer {cursor:pointer;}
        .bg-border {background-origin: border-box;}
        .rounded-lg{border-radius: 0.6rem !important;}
        .bg-center{background-position:center;}
        .bg-cover{background-size: cover;}
        .float-md-right{float:left}
        @media (max-width:576px){
        .d-sm-hidden{display:none !important;}
        .h6{font-size:1rem;}
        .fz-sm-2{font-size:2rem;}
        .gsc-search-button-v2{padding: 17px 20px !important;}
        .text-sm-small{font-size: 80%;}
        }
    </style>

    @hasSection('style')
        <style>
            \@yield('style')
        </style>
    @endif
    <script type="application/ld+json">{"@context":"http://schema.org","@type":"Organization","name":"Royal Anime","url":"http://www.royalanime.com/","address":"sameh.elalfi.mail@gmail.com","sameAs":["https://www.facebook.com/RoyalAnimeOfficial/","https://twitter.com/RoyalAnimeCom"]}</script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-164705179-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-164705179-1');
    </script>
    
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
    <script src='{{ cdn('js/jquery.min.js') }}'></script>
    <script src='{{ cdn('js/app.js') }}'></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <!-- Blog Posts Swiper -->
    <script>
        $(function() {
            $('.lazy').lazy({
                beforeLoad: function(e) {
                    // before load, store the gradient onto the element data
                    e.data("gradient", e.css("background-image"));
                },
                afterLoad: function(e) {
                    // afterwards create the wanted background image
                    e.css("background-image", e.data("gradient") + "," + e.css("background-image"));
                }
            });
        });
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

    @hasSection ('scripts')
        <script>
            @yield('scripts')
        </script>
    @endif
</body>
</html>
