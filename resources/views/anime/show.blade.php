@extends('layouts.app')

@section('content')

    @section('style')
    .modal-backdrop{z-index:0;}
    @endsection

    @section('header')
        <div class="position-relative">
            <section class="section section-lg section-hero section-shaped">
                
                <!-- Background Circles and Image -->
                <div class="shape shape-style-1 shape-primary" style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(20,0,100,0.8)), url('/{{ $anime->cover_url ?? $anime->image_url }}'); background-size: cover;background-position:center;">
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
                            <div class="text-center">
                                <!-- Header Brand -->
                                {{-- <img alt="image" src="{{ asset('img/brand/white.png') }}" style="width: 200px;" class="img-fluid"> --}}

                                <!-- Main Sentence -->
                                <a href="/animes/{{ $anime->id }}">
                                    <h1 class="text-white mb-5" dir="ltr">
                                        {{ $anime->title }}
                                        <br/>
                                        @if (strtolower($anime->title) != strtolower($anime->title_japanese))
                                            {{ $anime->title_japanese }}
                                        @endif
                                    </h1>
                                </a>
                                <br><br><br><br>
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

    <main class="profile-page overflow-visible">
        <section class="section">
            <div class="mx-4">
                <div class="card card-profile shadow-sm mt--300" style="z-index: 1;">
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-md-6 float-left align-self-lg-center">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="description">الحالة</span>
                                        <span class="heading">{{ $anime->status }}</span>
                                    </div>
                                    @if ($anime->rating)
                                        <div>
                                            <span class="description">النوع</span>
                                            <span class="heading">{{ $anime->rating }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 text-lg-right align-self-lg-center">
                                <div class="card-profile-actions py-4 mt-lg-0 mt-4">
                                    @if ($anime->type)
                                        <a href="#" class="btn btn-sm btn-info mr-4">{{$anime->type}}</a>
                                    @endif
                                    @foreach (json_decode($anime->genres) as $gender)
                                        <a href="#" class="btn btn-sm btn-default float-right mx-2 my-1">{{$gender}}</a>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                        <div class="pt-5 text-center">
                            <div class="row justify-content-center text-dark post">
                                <div class="col-lg-11">
                                    <div class="row mb-4">
                                        <div class="col-md-8">
                                            <h2>قصة الأنمي</h2>
                                            <p class="text-justify">
                                                {{$anime->arabic_synopsis}}
                                            </p>
                                            <a href="/animes/{{ $anime->id }}/episodes" class="btn btn-success col-10 my-2">مشاهدة وتحميل الأنمي</a>
                                            {{-- <a href="#" class="btn btn-secondary col-5 my-2">تحميل الأنمي</a> --}}
                                        </div>
                                        <div class="col-md-4 col-sm-12 text-center mt-md-5 mt-sm-4">
                                            {{-- <img src="{{ $anime -> Cover_url }}"> --}}
                                            <img src="{{$anime->image_url}}" class="mb-2">
                                                {{-- <button type="button" class="btn btn-block btn-primary mr-1 mt-4 col-lg-10 ml-lg-4" data-toggle="modal" data-target="#modal-notification">الإعلان التشويقي</button> --}}
                                                <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document" style="max-width: fit-content;">
                                                    <div class="modal-content bg-gradient-danger">
                                                        <div class="modal-header">
                                                        <h6 class="modal-title" id="modal-title-notification">الإعلان التشويقي</h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body px-sm-1 px-md-4">
                                                        <div class="py-3 text-center">
                                                            <iframe
                                                            width="100%"
                                                            height="300px"
                                                            src="https://www.youtube.com/embed/eRgjK23taLw"
                                                            srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=https://www.youtube.com/embed/eRgjK23taLw?autoplay=1><img src=https://img.youtube.com/vi/eRgjK23taLw/hqdefault.jpg alt='Video The Dark Knight Rises: What Went Wrong? – Wisecrack Edition'><span>▶</span></a>"
                                                            frameborder="0"
                                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen></iframe>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-white">Ok, Got it</button> -->
                                                        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            {{-- <a href="#" class="btn btn-primary col-10 mr-1 mt-4">الإعلان التشويقي</a> --}}
                                        </div>
                                        <br><br>
                                    </div>
                                    
                                    <div class="container">
                                        <div class="row card-profile-stats justify-content-center" style="color: #fff;
                                        border-radius: 14px;
                                        background: rgb(5,0,97);
                                        background: linear-gradient(-150deg,#281483 10%,#8f6ed5 60%,#ab5dad 94%);">
                                            <div class="col-md-2 col-sm-3">
                                                <span class="description text-white">عدد الحلقات</span>
                                                <span class="heading">{{ $anime->episodes ?? '?' }}</span>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <span class="description text-white">التقييم</span>
                                                <span class="heading">{{ $anime->score ?? '?' }}</span>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <span class="description text-white">عدد مرات التقييم</span>
                                                <span class="heading">{{ $anime->scored_by ?? '?' }}</span>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <span class="description text-white">الترتيب</span>
                                                <span class="heading">{{ $anime->rank ?? '?' }}</span>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <span class="description text-white">الشعبية</span>
                                                <span class="heading">{{ $anime->popularity ?? '?' }}</span>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <span class="description text-white">الأعضاء</span>
                                                <span class="heading">{{ $anime->members ?? '?' }}</span>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <span class="description text-white">في المفضلة لدى</span>
                                                <span class="heading">{{ $anime->favorites ?? '?' }} شخص</span>
                                                {{-- <span class="description">شخص</span> --}}
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <span class="description text-white">بدء في</span>
                                                <span class="heading">{{ $anime->aired_from ?? '?' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <span class="description text-white">انتهى في</span>
                                                <span class="heading">{{ $anime->aired_to ?? '?' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><hr>
                            <div class="container">
                                <h3 class="text-left">معلومات إضافية</h3>
                                <div class="row py-3 align-items-center">
                                    <div class="col-sm-3">
                                        <small class="text-uppercase text-muted font-weight-bold">الاسم الأنمي الياباني</small>
                                    </div>
                                    <div class="col-sm-9">
                                    <h5 class="mb-0">{{$anime->title_japanese != '' ? $anime->title_japanese : 'غير معروف'}}</h5>
                                    </div>
                                </div>
                                <div class="row py-3 align-items-center">
                                    <div class="col-sm-3">
                                        <small class="text-uppercase text-muted font-weight-bold">الاسم بالإنجليزي</small>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5 class="mb-0">{{$anime->title_english != '' ? $anime->title_english : 'غير معروف'}}</h5>
                                    </div>
                                </div>
                                @if ($anime->title_synonyms != "[]")
                                    <div class="row py-3 align-items-center">
                                        <div class="col-sm-3">
                                            <small class="text-uppercase text-muted font-weight-bold">أسماء أخرى</small>
                                        </div>
                                        <div class="col-sm-9">
                                            @foreach (json_decode($anime->title_synonyms) as $item)
                                            <h5 class="mb-0">{{$item ?? 'غير معروف'}}</h5>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="row py-3 align-items-center">
                                    <div class="col-sm-3">
                                        <small class="text-uppercase text-muted font-weight-bold">متوسط طول الحلقة</small>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5 class="mb-0">{{$anime->duration != '' ? $anime->duration : 'غير معروف'}}</h5>
                                    </div>
                                </div>
                                <div class="row py-3 align-items-center">
                                    <div class="col-sm-3">
                                        <small class="text-uppercase text-muted font-weight-bold">الموسم</small>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5 class="mb-0">{{$anime->premiered != '' ? $anime->premiered : 'غير معروف'}}</h5>
                                    </div>
                                </div>
                                <div class="row py-3 align-items-center">
                                    <div class="col-sm-3">
                                        <small class="text-uppercase text-muted font-weight-bold">يوم بث الحلقات</small>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5 class="mb-0">{{$anime->broadcast != '' ? $anime->broadcast : 'غير معروف'}}</h5>
                                    </div>
                                </div>
                                <div class="row py-3 align-items-center">
                                    <div class="col-sm-3">
                                        <small class="text-uppercase text-muted font-weight-bold">النوع</small>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5 class="mb-0">{{$anime->rating != '' ? $anime->rating : 'غير معروف'}}</h5>
                                    </div>
                                </div>
                                @if ($anime->notes)
                                    <div class="row py-3 align-items-center">
                                        <div class="col-sm-3">
                                            <small class="text-uppercase text-muted font-weight-bold">ملاحظات</small>
                                        </div>
                                        <div class="col-sm-9">
                                            @foreach (explode(', ', $anime->notes) as $note)
                                                <h5 class="mb-0">{{$note}}</h5>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <h3>معلومات إضافية عن القصة</h3>
                            @if ($anime->background)
                                <p class="text-justify text-center">
                                    {{$anime->background}}
                                </p>
                                <hr>
                            @endif
                            @if ($anime->wikipedia_synopsis)
                                <p class="text-justify text-center">
                                    {!! $anime->wikipedia_synopsis !!}
                                </p>
                                <hr>
                            @endif
                            <div class="row">
                                <div class="col-md-6 col-sm-12" dir="ltr">
                                    <h3>موسيقى البداية</h3>
                                    @foreach (json_decode($anime->opening_themes) as $key => $opening_theme)
                                        <a class="btn btn-icon btn-3 btn-outline-secondary col-12 my-1 mr-0" type="button" href="https://www.youtube.com/results?search_query={{ $opening_theme }}" target="_blank" >
                                            <span class="btn-inner--icon float-left text-warning"><i class="fa">#{{ ++$key }}</i></span>
                                            <span class="btn-inner--text">{{$opening_theme}}</span>
                                            </a>
                                    @endforeach
                                </div>
                                <div class="col-md-6 col-sm-12text-justify" dir="ltr">
                                    <h3>موسيقى النهاية</h3>
                                    @foreach (json_decode($anime->ending_themes) as $key => $ending_theme)
                                    <a class="btn btn-icon btn-3 btn-outline-secondary col-12 my-1 mr-0" type="button" href="https://www.youtube.com/results?search_query={{ $ending_theme }}" target="_blank" >
                                                <span class="btn-inner--icon float-left text-warning"><i class="fa">#{{ ++$key }}</i></span>
                                                <span class="btn-inner--text">{{$ending_theme}}</span>
                                                </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div class="text-center my-5 floating-sm">
                            <span class="text-">أخبر العالم عن هذا الأنمي </span>
                            <div class="my-3 d-inline mx-3">
                                <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </div>
                        </div>
                        <div id="disqus_thread"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('layouts.comments', ['page_url' => 'https://daveismyname.blog/creating-a-blog-from-scratch-with-php-part-3-comments-with-disqus', 'page_identifier' => 'animes-' . $anime->id])
@endsection