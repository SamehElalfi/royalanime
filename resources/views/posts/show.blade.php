@extends('layouts.app')

@section('header')
<div class="position-relative">
    <section class="section section-lg section-hero section-shaped colored-bg-dark">
        
        <!-- Background Circles and Image -->
        <div class="shape shape-style-1 shape-primary" style="background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url('{{ $post["cover"] ?? cdn("img/backgrounds/bg-1.webp") }}'); background-size: cover;">
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
        

        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
</div>
@endsection

@section('content')
<main class="profile-page overflow-visible">
    <section class="section">
        <div class="p-sm-0 p-md-4 p-lg-5">
            <div class="card card-profile shadow-sm mt--300">
                <div class="px-4">
                    <div class="row justify-content-center">
                        
                        <div class="col-lg-4 order-lg-1 text-left align-self-lg-center">
                            <div class="card-profile-actions py-4 mt-lg-0 mt-4">
                                <span>نشرت في:</span>
                                <div>{{ $post->created_at }}</div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-4 order-lg-2 text-lg-right align-self-lg-center">
                            <div class="card-profile-actions py-4 mt-lg-0 mt-4">
                                <h3>
                                    {{ $post['title'] }}
                                </h3>
                            </div>
                        </div> -->
                        <div class="col-lg-4 order-lg-3 card-profile-actions py-4 mt-lg-0 mt-4 m-auto">
                            @if($post->tags)
                            @foreach(explode(',', $post->tags) as $tag)
                                @if ($tag)
                                    <a href="/blog/tags/{{$tag}}" class="btn btn-sm btn-default float-right mr-3">{{ $tag }}</a>
                                @endif
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- <div class="card-profile-actions py-4 mt-lg-0 mt-4 m-auto">
                        @if($post->tags)
                        @foreach(explode(',', $post->tags) as $tag)
                            @if ($tag)
                                <a href="/blog/tags/{{$tag}}" class="btn btn-sm btn-default float-right mr-3">{{ $tag }}</a>
                            @endif
                        @endforeach
                        @endif
                    </div> -->

                    <div class="text-center mt-5">
                        <h3>
                            {{ $post['title'] }}
                        </h3>
                        <div class="h6 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{$post->user->name}}
                        </div>
                    </div>

                    <div class="pt-5 text-center">
                        <div class="row justify-content-center text-dark post">
                            <div class="col-lg-11">
                                {!! $post['content'] !!}
                            </div>
                        </div>
                    </div>

                    @include('layouts.share_buttons', ['title' => 'شارك هذه المقالة'])

                    <div id="disqus_thread"></div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('layouts.blog_section', ['posts'=>''])
@endsection
