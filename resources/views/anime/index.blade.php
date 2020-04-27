@extends('layouts.app')
@section('content')
    {{-- @if ($paginator->onFirstPage())
        <!-- Slide Show -->
        <section class="section section-components profile-page pt-0 pb-0" id="section-components">
            <div id="carousel_example" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel_example" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel_example" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="http://www.google.com"><img class="img-fluid" src="{{ cdn(/img/11.webp) ?? '' }}" alt="First slide"></a>
                    </div>
                    <div class="carousel-item">
                        <a href="http://www.facebook.com"><img class="img-fluid" src="{{ cdn(/img/12.webp) ?? '' }}" alt="First slide"></a>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel_example" role="button" data-slide="prev">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
                <a class="carousel-control-next" href="#carousel_example" role="button" data-slide="next">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
            </div>
        </section>
    @endif --}}

    <!-- Latest Anime -->
    <section class="section section-components profile-page" id="section-components">
        <div class="container">
            @if ($paginator->items())
                <!-- Section Title -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2 class="mb-5" id="new-anime">
                            <span>قائمة الأنميات</span>
                        </h2>
                    </div>
                </div>
            @endif
            
            @if (!$paginator->items())
                <div class="text-center">
                    <i class="fa fa-frown-o" style="font-size: 10em;"></i>
                    <p class="lead">هذه الصفحة لا تحتوي على أي أنميات، هل تريد مشاهدة قائمة الأنميات؟</p>
                    <div class="btn-wrapper mt-5">
                        <a href="/animes" class="btn btn-lg btn-github btn-icon mb-3 mb-sm-0">
                            <span class="btn-inner--icon"><i class="fa fa-th-large"></i></span>
                            <span class="btn-inner--text">قائمة <span class="text-warning">الأنمي</span></span>
                        </a>
                        <a href="/episodes" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
                            <span class="btn-inner--icon"><i class="fa fa-television"></i></span>
                            <span class="btn-inner--text">أحدث الحلقات</span>
                        </a>
                    </div>
                </div>
            @else
                <!-- Latest Anime Cards -->
                @foreach ($paginator->items() as $item)
                    @include('layouts.anime_card', ['anime'=> $item])
                @endforeach

                <div class="col-12 text-center">
                    @include('layouts.pagination')
                </div>
            @endif

        </div>
    </section>

    {{-- Best Blogposts in a slidshow --}}
    @include('layouts.blog_section')

@endsection