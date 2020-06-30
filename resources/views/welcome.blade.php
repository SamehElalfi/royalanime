@extends('layouts.app')
@section('content')

    @section('header')
        <div class="position-relative">
            <section class="section section-lg section-hero section-shaped">
                
                <!-- Background Circles and Image -->
                <div class="shape shape-style-1 bg-cover colored-bg-transparent" style='background: url(img/backgrounds/bg-1.webp);background-size: cover;'>
                    <span class="span-150"></span>
                    <span class="span-50"></span>
                    <span class="span-50"></span>
                    <span class="span-75"></span>
                    <span class="span-100"></span>
                    <span class="span-75"></span>
                    <span class="span-50"></span>
                    <span class="span-100"></span>
                    <span class="span-50"></span>
                    <span class="span-100"></span>
                </div>

                <!-- Header Content -->
                <div class="container shape-container d-flex align-items-center py-lg">
                    <div class="col px-0">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-6 text-center">
                                <!-- Header Brand -->
                                <img alt="image" src="{{ cdn('img/brand/white.webp') }}" style="width: 200px;" class="img-fluid">

                                <!-- Main Sentence -->
                                <h1 class="lead text-white h2">المنزل الملكي لكل الأنمي.<br/>كل ما يحتاجه الأوتاكو في مكان واحد.</h1>

                                <!-- Links' Buttons -->
                                <div class="btn-wrapper mt-5">
                                    <a href="/animes" class="btn btn-lg btn-github btn-icon mb-3 mb-sm-0">
                                        <span class="btn-inner--icon"><i class="fa fa-th-large"></i></span>
                                        <span class="btn-inner--text">قائمة <span class="text-warning">الأنمي</span></span>
                                    </a>
                                    <a href="{{ route('episodes') }}" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
                                        <span class="btn-inner--icon"><i class="fa fa-television"></i></span>
                                        <span class="btn-inner--text">أحدث الحلقات</span>
                                    </a>
                                </div>

                                <!-- Secondary Sentence -->
                                <div class="mt-5">
                                    <span class="text-white font-weight-bold mb-0 mr-2">صنع بكل <i class="fa fa-heart text-warning"></i> لماتبعي الأنمي.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SVG separator -->
                <div class="separator separator-bottom separator-skew zindex-100">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
            </section>
        </div>
    @endsection

    <!-- Latest Anime -->
    <section class="section section-components profile-page" id="section-components">
        <div class="container">
            <!-- Section Title -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2 class="mb-5" id="new-anime">
                        <span>أفضل الأنميات</span>
                    </h2>
                </div>
            </div>
                
            <!-- Best Anime Cards -->
            @forelse ($animes as $anime)
                @include('layouts.anime_card')
            @empty
                <div class="text-center">
                    <i class="fa fa-frown-o" style="font-size: 10em;"></i>
                    <p class="lead">
                        عذرًا، لا توجد أي أنميات في الوقت الحالي. نحن نعمل على قدم وساق لإيصال المتعة لقلوبكم في أقرب وقت ممكن. شكرًا على تفهمكم. __ إدارة رويال أنمي
                    </p>
                </div>
            @endforelse

            <!-- Watch All Animes or Anime Categories -->
            <div class="col-12 text-center">
                <div class="btn-wrapper">
                    <a href="/animes" class="btn btn-primary btn-lg">مشاهدة كل الأنميات</a>
                    <a href="/tags" class="btn btn-default btn-lg">تصنيفات الأنمي</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Anime Movies -->
    <section class="section section-shaped">

        <!-- Background Circles -->
        <div class="shape shape-style-1 shape-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container py-md">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <!-- Section Title and Description -->
                    <h2 class="text-white font-weight-light h1">أفلام الأنمي</h2>
                    <p class="lead text-white mt-4">يحتوي موقع رويال أنمي على الآلاف من مسلسلات الأنمي بالإضافة إلى المئات من أفلام الأنمي أيضًا. يمكنك مشاهدة وتحميل أحدث أفلام الأنمي بروابط مباشرة من هنا.</p>
                    <a href="{{ route('types.show', ['type'=>'Movie']) }}" class="btn btn-white mt-4">أحدث أفلام الأنمي</a>
                </div>

                <!-- SlideShow -->
                @include('layouts.slideshow', [
                    'images' => [
                        ['link' => "#", 'src' => "img/11.webp", 'alt' => "First slide"],
                        ['link' => "#", 'src' => "img/12.webp", 'alt' => "First slide"]
                    ]
                ])
            </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>

    <!-- Thaousands of Episodes -->
    <section class="section section-lg section-nucleo-icons">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <!-- Section Title -->
                    <h2 class="display-3">الآلاف من الحلقات</h2>

                    <!-- Section Descrption -->
                    <p class="lead">موقع رويال أنمي يحتوي على أكثر من 40.000 حلقة أنمي لأكثر من 2.000 مسلسل متنوع في أكثر من 35 تصنيف مختلف. كل الأنميات الموجودة في الموقع تم إنتاجها بواسطة أكبر أستديوهات الأنمي المعروفة.</p>
                    
                    <!-- Section Buttons -->
                    <div class="btn-wrapper">
                        <a href="{{ route('tags.index') }}" class="btn btn-primary">مشاهدة الأنمي بحسب التصنيف</a>
                        <a href="{{ route('animes.index') }}?sortBy=score&order=DESC" target="_blank" class="btn btn-default mt-3 mt-md-0">مشاهدة الأنميات بحسب التقييم</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Be Conected with Us -->
    <section class="section section-lg section-shaped">

        <!-- Background Circles -->
        <div class="shape shape-style-1 shape-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Section Content -->
        <div class="container py-md">
            <div class="row row-grid justify-content-between align-items-center">
                <div class="col-lg-6">

                    <!-- Section Title and Description-->
                    <h3 class="display-3 text-white">فلتكن دائمًا على تواصل<span class="text-white">بريد إلكتروني = آخر الحلقات</span></h3>
                    <p class="lead text-white">لقد قمنا في رويال أنمي بتصميم برنامج خاص لإرسال رسائل لك خصيصًا، حتى تظل متابع لأنمياتك المفضلة وآخر أخبارها. ضع بريدك الإلكتروني، و إختر التصنيفات التي تريد أن تصلك آخر حلقاتها وأخبارها بروابط مباشرة وبدون إعلانات.</p>
                    
                    <!-- Section Buttons -->
                    <div class="btn-wrapper">
                        <a href="/subscriber" class="btn btn-success">إشترك الآن</a>
                        {{-- <a href="examples/register.html" class="btn btn-white">إعدادات بريدك الإلكتروني</a> --}}
                    </div>
                </div>

                <!-- subscriber List -->
                <div class="col-lg-5 mb-lg-auto">
                    <div class="transform-perspective-right">
                        <div class="card bg-secondary shadow border-0 floating">
                            <div class="card-body px-lg-5 py-lg-5">
                                <!-- Form Sentence -->
                                <div class="text-center text-muted mb-4">
                                    <small>ضع بريدك الإلكتروني وإختر التصنيفات التي تريد أن تصلك آخر تحديثاتها.</small>
                                </div>

                                <form method="POST" action="/subscriber">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope "></i></span>
                                            </div>
                                            <input class="form-control" placeholder="البريد الإلكتروني" type="email" name="email">
                                            <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
                                            <input type="hidden" name="current_url" value="{{ url()->current() }}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="input" class="btn btn-primary my-4">إشتراك *</button>
                                    </div>
                                </form>

                                <!-- Form Warning -->
                                <div class="text-center text-muted mb-4 color-primary primary ">
                                    <small class="text-warning opacity-5">* بالضغط على زر الإشتراك تكون قد قبلت شروط الموقع بلا أي إستثناء</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>

    {{-- Best Blogposts in a slidshow --}}
    @include('layouts.blog_section')

@endsection