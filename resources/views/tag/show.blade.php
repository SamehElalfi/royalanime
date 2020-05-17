@extends('layouts.app')
@section('content')

    <!-- Latest Anime -->
    <section class="section section-components profile-page" id="section-components">
        <div class="container">
            @if ($paginator->items())
                <!-- Section Title -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h1 class="mb-5 h2" id="new-anime">
                            <span>أنمي {{ $id }}</span>
                            <a href="{{ route('tags.index') }}" class="btn btn-outline-primary float-right">قائمة التصنيفات</a>
                        </h1>
                    </div>
                    @include('layouts.sort_by')
                </div>
            @endif
            
            @if (!$paginator->items())
                <div class="text-center">
                    <i class="fa fa-frown-o" style="font-size: 10em;"></i>
                    <p class="lead">هذه الصفحة لا تحتوي على أي أنميات، هل تريد مشاهدة قائمة الأنميات المتاحة؟</p>
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