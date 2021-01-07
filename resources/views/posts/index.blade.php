@extends('layouts.app')

@if ($paginator->onFirstPage())
    <!-- Slide Show -->
    <section class="section section-components profile-page pt-5 pb-0" id="section-components">
        <div id="carousel_example" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel_example" data-slide-to="0" class="active"></li>
                <li data-target="#carousel_example" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="http://www.google.com"><img style="max-height:530px;" class="w-100" src="{{ cdn('/img/11.webp') ?? '' }}" alt="First slide"></a>
                </div>
                <div class="carousel-item">
                    <a href="http://www.facebook.com"><img style="max-height:530px;" class="w-100" src="{{ cdn('/img/12.webp') ?? '' }}" alt="First slide"></a>
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
@endif

<section class="section section-components profile-page pt-0 mt-5" id="section-components">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <!-- Basic elements -->
                <h2 class="mb-0" id="new-anime">
                    <span>آخر المقالات</span>
                </h2>
            </div>
        </div>
    </div>

    @foreach ($paginator->items() as $post)
        @include('layouts.post_card', ['post' => $post])
    @endforeach
</section>

<div class="col-12 text-center">
    @include('layouts.pagination')
</div>
