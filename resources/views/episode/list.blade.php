@extends('layouts.app')
@section('content')

<!-- Latest Anime -->
<section class="section section-components profile-page" id="section-components">
    <div class="mx-5">
        @if ($paginator->items())
        <!-- Section Title -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1 class="mb-5 h2" id="new-anime">
                    <span>قائمة الحلقات</span>
                </h1>
            </div>
        </div>
        @endif

        @if (!$paginator->items())
        <div class="text-center">
            <i class="fa fa-frown-o" style="font-size: 10em;"></i>
            <p class="lead">هذه الصفحة لا تحتوي على أي أنميات، هل تريد مشاهدة قائمة الأنميات المتاحة؟</p>
            <div class="btn-wrapper mt-5">
                <a href="{{ route('animes.index') }}" class="btn btn-lg btn-github btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="fa fa-th-large"></i></span>
                    <span class="btn-inner--text">قائمة <span class="text-warning">الأنمي</span></span>
                </a>
                <a href="{{ route('animes.episodes.list') }}" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="fa fa-television"></i></span>
                    <span class="btn-inner--text">أحدث الحلقات</span>
                </a>
            </div>
        </div>
        @else
        <div class="row">
            <!-- Latest Anime Cards -->
            @foreach ($paginator->items() as $item)
            @include('layouts.episode_card', ['episode'=> $item])
            @endforeach
        </div>
        <div class="col-12 text-center my-5">
            @include('layouts.pagination')
        </div>
        @endif

    </div>
</section>

{{-- Best Blogposts in a slidshow --}}
@include('layouts.blog_section')

@endsection
