@extends('layouts.app')
@section('content')

    @section('header')
        <section class="section-profile-cover section-shaped my-0">
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
                            <div class="card-body p-lg-5">
                                <h4 class="mb-1">تريد أن تقول لنا شيء ما؟</h4>
                                <p class="mt-0">قل لنا كل ما تريده، فكل كلماتك مهمة بالنسبة لنا!</p>
                                <form action="/contact" method="post">

                                    @csrf

                                    {{-- Previous Link Input --}}
                                    <input type="hidden" name="previous_url" value="{{ url()->previous() ?? '' }}">

                                    {{-- Name Input --}}
                                    <div class="form-group mt-5">
                                        <div class="input-group input-group-alternative {{ $errors->has('name') ? 'has-danger' : ''}}">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-user-run"></i></span>
                                            </div>
                                            <input class="form-control" name="name" placeholder="اسمك" type="text" value="{{ old('name') }}" required>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>

                                    {{-- Email Input --}}
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative {{ $errors->has('email') ? 'has-danger' : ''}}">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" name="email" placeholder="بريدك الإلكتروني" type="email"  value="{{ old('email') }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>

                                    {{-- Message Input --}}
                                    <div class="form-group mb-4 {{ $errors->has('message') ? 'has-danger' : ''}}">
                                        <textarea class="form-control form-control-alternative" name="message" rows="4" cols="80" placeholder="أكتب رسالتك..."  value="{{ old('message') }}" required></textarea>
                                        @if ($errors->has('message'))
                                            <span class="text-danger">{{$errors->first('message')}}</span>
                                        @endif
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-default btn-round btn-block btn-lg">إرسال</button>
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
