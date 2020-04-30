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
                                <h4 class="mb-1">تابع كل جديد من بريدك الإلكتروني مباشرةً</h4>
                                <p class="mt-0">إشترك الآن وستصلك رسائل مجانية بكل الأخبار وجديد الأنميات!</p>
                                <form action="/mail" method="post">

                                    @csrf
                                    
                                    <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
                                    <input type="hidden" name="current_url" value="{{ url()->current() }}">
                                    
                                    <div class="form-group my-5">
                                        <div class="input-group input-group-alternative ">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <input class="form-control" name="email" placeholder="بريدك الإلكتروني" type="email" value="" required="">
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-default btn-round btn-block btn-lg">إشتراك</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection