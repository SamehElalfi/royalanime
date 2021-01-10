@extends('layouts.app')
@section('content')

@section('header')
<div class="position-relative">
    <section class="section section-lg section-hero section-shaped">

        <!-- Background Circles and Image -->
        <div class="shape shape-style-1 lazy loading-img colored-bg-dark bg-cover bg-center"
            data-src="{{ $episode->anime->cover_url != '' ? $episode->anime->cover_url : $episode->anime->image_url }}">
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
                        {{-- <img alt="image" src="{{ cdn('img/brand/white.webp') }}" style="width: 200px;"
                        class="img-fluid"> --}}

                        <!-- Main Sentence -->
                        <a
                            href="{{ route('animes.show', ['anime'=>$episode->anime->id]) }}/{{ Str::slug($episode->anime->title) }}">
                            <h1 class="text-white mb-5 fz-sm-2" dir="ltr">
                                {{ $episode->anime->title }}
                                <br />
                                @if (strtolower($episode->anime->title) != strtolower($episode->anime->title_japanese))
                                {{ $episode->anime->title_japanese }}
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
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
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
                            <div class="card-profile-stats d-flex">
                                <div>
                                    <span class="description">نشرت في</span>
                                    <span class="heading">{{ $episode->aired }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-lg-right align-self-lg-center">
                            <div class="card-profile-actions py-4 mt-lg-0 mt-4">
                                @if ($episode->recap)
                                <a href="#" class="btn btn-sm btn-success mr-4">ملخص</a>
                                @endif
                                @if ($episode->filler)
                                <a href="#" class="btn btn-sm btn-danger mr-4">فلر</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h1 class="text-center fz-sm-2">حلقة {{$episode->episode_number}} <br> <span
                            dir="ltr">{{$episode->title}}</span></h1>
                    <div class="pt-5 text-center">

                        {{-- Watching Servers --}}
                        <div class="row justify-content-center text-dark post">
                            <h2 class="col-12">سيرفرات المشاهدة</h2>
                            <div class="col-g-11">
                                <div class="row mb-4">
                                    <div class="col-102">
                                        <div class="mt-5 mt-lg-0">
                                            @if ($stream_links)
                                            <div class="nav-wrapper">
                                                <ul class="nav nav-pills nav-fill flex-md-row" id="tabs-text"
                                                    role="tablist">
                                                    @foreach(array_reverse($stream_links) as $key => $item)
                                                    <li class="nav-item pr-0 mx-1 my-2">
                                                        <a class="nav-link mb-sm-3 mb-md-0 text-uppercase {{ $loop->first ? 'active' : '' }}"
                                                            id="tabs-text-1-tab" data-toggle="tab"
                                                            href="#tabs-text-{{$key}}" role="tab"
                                                            aria-controls="tabs-text-{{$key}}"
                                                            aria-selected="{{$loop->first}}">سيرفر {{$item->name}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-body bg-dark p-0 p-md-3">
                                                    <!-- <button onclick="document.getElementById('myTabContent').requestFullscreen()" class="btn btn-primary" style="font-size:3rm; color:white;">وضع ملئ الشاشة</button> -->
                                                    <div class="tab-content" id="myTabContent">
                                                        @foreach(array_reverse($stream_links) as $key => $item)
                                                        <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                                            id="tabs-text-{{$key}}" role="tabpane{{$key}}"
                                                            aria-labelledby="tabs-text-{{$key}}-tab">
                                                            <iframe width="100%" class="h-400"
                                                                src="/royalembed/{{$item->link}}"
                                                                srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=/royalembed/{{$item->link}}><span>▶</span></a>"
                                                                frameborder="0"
                                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                                allowfullscreen title="{{$item->name}}"
                                                                id="server-{{$item->name}}"></iframe>
                                                        </div>
                                                        @endforeach
                                                        <span class="text-white h6 text-muted text-sm-small">
                                                            <span class="text-danger">تنويه:</span>
                                                            بعض الحلقات مرفوعه على مواقع تعرض إعلانات مزعجة خلال
                                                            الحلقات. نحن نعمل على إعادة رفع هذه الحلقات إلى مواقع رفع
                                                            أفضل حاليًا شكرًا لتفهمكم.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <span>لا توجد روابط متاحة لمشاهدة هذه الحلقة في الوقت الحاضر، لكننا سنضيفها
                                                في أقرب وقت ممكن.</span>
                                            @endif

                                        </div>
                                        <br>
                                        <hr>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        </div>

                        {{-- Additional Information --}}
                        <div class="container">
                            <h3 class="text-left">معلومات إضافية</h3>

                            @if ($episode->title)
                            <div class="row py-3 align-items-center">
                                <div class="col-sm-3">
                                    <small class="text-uppercase text-muted font-weight-bold">عنوان الحلقة</small>
                                </div>
                                <div class="col-sm-9" dir="ltr">
                                    <h5 class="mb-0">{{$episode->title}}</h5>
                                </div>
                            </div>
                            @endif

                            @if ($episode->title_japanese)
                            <div class="row py-3 align-items-center">
                                <div class="col-sm-3">
                                    <small class="text-uppercase text-muted font-weight-bold">عنوان الحلقة
                                        الياباني</small>
                                </div>
                                <div class="col-sm-9" dir="ltr">
                                    <h5 class="mb-0">{{$episode->title_japanese}}</h5>
                                </div>
                            </div>
                            @endif

                            @if ($episode->title_romanji)
                            <div class="row py-3 align-items-center">
                                <div class="col-sm-3">
                                    <small class="text-uppercase text-muted font-weight-bold">عنوان الحلقة
                                        بالرومانجي</small>
                                </div>
                                <div class="col-sm-9" dir="ltr">
                                    <h5 class="mb-0">{{$episode->title_romanji}}</h5>
                                </div>
                            </div>
                            @endif


                            @if ($episode->length)
                            <div class="row py-3 align-items-center">
                                <div class="col-sm-3">
                                    <small class="text-uppercase text-muted font-weight-bold">طول الحلقة</small>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="mb-0">{{$episode->length}}</h5>
                                </div>
                            </div>
                            @endif

                            @if ($episode->notes)
                            <div class="row py-3 align-items-center">
                                <div class="col-sm-3">
                                    <small class="text-uppercase text-muted font-weight-bold">ملاحظات</small>
                                </div>
                                <div class="col-sm-9">
                                    <h5 class="mb-0">{{$episode->notes}}</h5>
                                </div>
                            </div>
                            @endif
                        </div>

                        <hr>
                        {{-- Download Servers --}}
                        <h2>سيرفرات التحميل</h2>
                        <div class="row justify-content-center text-dark post">
                            @if ($download_links)
                            @foreach ($download_links as $linkrow)
                            <a href="{{$linkrow->link}}"
                                class="btn {{$episode->filler ? 'btn-danger' : 'btn-primary'}} col-12 col-md-5 my-1 mx-1">
                                <span class="float-left">#{{$loop->iteration}}</span>
                                <span>{{$linkrow->name ?? $linkrow->link}}</span>
                                {{-- <span class="float-right">
                                            {{ $linkrow->size ? $linkrow->size .'MB' : ''}}
                                {{ ($linkrow->size && $linkrow->quality) ? ' - ' : '' }}
                                {{ $linkrow->quality ? $linkrow->quality . 'P' : ''}}
                                </span> --}}
                            </a>
                            @endforeach
                            @else
                            <span>لا توجد روابط متاحة لتحميل هذه الحلقة في الوقت الحاضر، لكننا سنضيفها في أقرب وقت
                                ممكن.</span>
                            @endif
                        </div>
                    </div>

                    <br>
                    <hr><br>

                    <div class="text-center">
                        {{-- Previous Episode --}}
                        @if ($episode->episode_number > 1)
                        <a class="btn btn-icon btn-3 btn-default col-md-4 col-sm-12"
                            href="{{ route('animes.episodes.show', ['anime'=>$episode->anime->id, 'episode'=>$episode->episode_number-1]) }}">
                            <span class="btn-inner--icon"><i class="fa fa-angle-right"></i></span>
                            <span class="btn-inner--text">الحلقة السابقة</span>
                        </a>
                        @endif

                        {{-- All Episodes --}}
                        <a class="btn btn-icon btn-3 btn-warning col-md-3 col-sm-12 mx-md-4 my-1"
                            href="{{ route('animes.episodes.index', ['anime'=>$episode->anime->id]) }}">
                            <span class="btn-inner--text">كل الحلقات</span>
                        </a>

                        {{-- Next Episode --}}
                        {{-- Check if there is more episodes --}}
                        @if ($episode->episode_number < $episode->anime->episodesList->count())
                            <a class="btn btn-icon btn-3 btn-default col-md-4 col-sm-12"
                                href="{{ route('animes.episodes.show', ['anime'=>$episode->anime->id, 'episode'=>$episode->episode_number+1]) }}">
                                <span class="btn-inner--text">الحلقة التالية</span>
                                <span class="btn-inner--icon"><i class="fa fa-angle-left"></i></span>
                            </a>
                            @endif
                    </div>

                    {{-- Share Buttons --}}
                    @include('layouts.share_buttons', ['title'=>'أخبر العالم عن هذه الحلقة'])

                    <div id="disqus_thread"></div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('layouts.comments', ['page_identifier' => 'animes-' . $episode->anime->id .'-episodes-'.
$episode->episode_number])
@endsection
