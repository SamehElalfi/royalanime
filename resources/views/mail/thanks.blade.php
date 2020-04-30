@extends('layouts.app')
@section('content')

    @section('header')
        <section class="section-profile-cover section-shaped my-0 mb-300">
            <!-- Circles background -->
                <div class="shape shape-style-1 shape-primary alpha-4">
                    <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <!-- SVG separator -->
                <div class="separator separator-bottom separator-skew">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>
    @endsection

    <main class="profile-page overflow-visible">
        <section class="section section-lg pt-lg-0 section-contact-us">
            <div class="container">
                <div class="row justify-content-center mt--300">
                    <div class="col-lg-8">
                        <div class="card bg-gradient-secondary shadow">
                            <div class="card-body p-lg-5 text-center">
                                <i class="fa fa-check-circle fa-5x mb-4 text-success" style="font-size: 7em;"></i>
                                <h4 class="mb-1">من الآن ستصلك آخر الأخبار على بريدك الإلكتروني</h4>
                                <p class="mt-0">إنتظر منا رسائل إلى بريدك الإلكتروني</p>
                                <p class="mt-0">ما رأيك الآن بمشاهدة بعض الأنميات الجديدة 
                                    <a href="/animes">من هنا</a>
                                </p>
                                <a href="/animes" class="btn btn-default">قائمة الأنميات</a>
                                @isset($previous_url)
                                    <a href="{{ $previous_url ?? '/' }}" class="btn btn-outline-primary">عودة</a>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection