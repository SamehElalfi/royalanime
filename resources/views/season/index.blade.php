@extends('layouts.app')
@section('content')

    <!-- Latest Anime -->
    <section class="section section-components profile-page" id="section-components">
        <div class="container text-center">
            
            <!-- Section Title -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h1 class="mb-5 h2" id="new-anime">
                        <span>كل مواسم الأنمي</span>
                    </h1>
                </div>
            </div>

            @foreach ($seasons as $season)
                <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="{{ route('seasons.show', ['season'=> $season]) }}">{{ $season }}</a>    
            @endforeach

            <div class="text-center">
                {{-- <i class="fa fa-frown-o" style="font-size: 10em;"></i> --}}
                <p class="lead">هذه الصفحة لا تحتوي على أي أنميات، وإنما فقط كل مواسم الأنمي التي لدينا، يمكنك مشاهدة قائمة الأنميات أو البحث في أكثر من 40.000 حلقة لدينا.</p>
                <div class="btn-wrapper mt-5">
                    <a href="/animes" class="btn btn-lg btn-github btn-icon mb-3 mb-sm-0">
                        <span class="btn-inner--icon"><i class="fa fa-th-large"></i></span>
                        <span class="btn-inner--text">قائمة <span class="text-warning">الأنمي</span></span>
                    </a>
                    <a href="/search" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
                        <span class="btn-inner--icon"><i class="fa fa-television"></i></span>
                        <span class="btn-inner--text">أبحث في الموقع</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- Best Blogposts in a slidshow --}}
    @include('layouts.blog_section')

@endsection