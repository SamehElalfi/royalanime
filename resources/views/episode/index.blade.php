@extends('layouts.app')
@section('content')


    @section('header')
        <div class="position-relative">
            <section class="section section-lg section-hero section-shaped">
                
                <!-- Background Circles and Image -->
                <div class="shape shape-style-1 lazy loading-img colored-bg-dark bg-cover bg-center" data-src="{{ $anime->cover_url != '' ? $anime->cover_url : $anime->image_url }}">
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
                                {{-- <img alt="image" src="{{ cdn('img/brand/white.webp') }}" style="width: 200px;" class="img-fluid"> --}}

                                <!-- Main Sentence -->
                                <a href="/animes/{{$anime->id}}">
                                    <h1 class="text-white mb-5 fz-sm-2" dir="ltr">
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
                <div class="card card-profile shadow-sm mt--300">
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-md-6 float-left align-self-lg-center">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="description">الحالة</span>
                                        <span class="heading">{{ $anime->status ?? 'غير معروف' }}</span>
                                    </div>
                                    <div>
                                        <span class="description">التقيم</span>
                                        <span class="heading">{{ $anime->rating ?? 'غير معروف' }}</span>
                                    </div>
                                    <div>
                                        <span class="description">عدد الحلقات</span>
                                        <span class="heading">{{ $anime->episodes ?? 'غير معروف' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-lg-right align-self-lg-center">
                                <div class="card-profile-actions py-4 mt-lg-0 mt-4">
                                    @foreach (json_decode($anime->genres) as $gender)
                                        <a href="/tags/{{$gender}}" class="btn btn-sm btn-default float-right mx-2 my-1">{{$gender}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-5 text-center">
                            <div class="row justify-content-center text-dark post">
                                <div class="col-lg-11">
                                    <div class="row mb-4">
                                        <div class="col-12 my-4">
                                        <button class="btn btn-icon btn-3 btn-outline-default" type="button" onclick="reverseChildren()">
                                            <span class="btn-inner--text">ترتيب الحلقات</span>
                                            <span class="btn-inner--icon">
                                                <i class="fa fa-sort-numeric-asc" id="order-btn"></i>
                                            </span>
                                        </button>
                                        </div>
                                        <div class="col-12" id="eps">
                                            @foreach ($episodes as $episode)
                                                <a
                                                href="/animes/{{ $anime->id }}/episodes/{{$episode->episode_number}}"
                                                class="btn btn-lg {{ $episode->filler ? 'btn-danger' : ($episode->recap ? 'btn-success' : 'btn-primary') }} col-md-5 col-sm-12 my-1 mx-1"
                                                dir="ltr">
                                                    <span class="float-left col col-3">
                                                        {{$episode->episode_number}}
                                                        <br>
                                                        <span>{{$episode->filler ? 'فلر' : ''}}</span>
                                                        <span>{{$episode->recap ? 'ملخص' : ''}}</span>
                                                        <br>
                                                    </span>
                                                    <span class="col col-9">{{$episode->title}}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Share Buttons --}}
                        @include('layouts.share_buttons', ['title'=>'أخبر العالم عن هذا الأنمي'])
                        
                        <div id="disqus_thread"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    @section('scripts')
        /* Re-order Episodes Button */
        function reverseChildren() {
            parent = document.getElementById("eps");
            for (var i = 1; i < parent.childNodes.length; i++){
                parent.insertBefore(parent.childNodes[i], parent.firstChild);
            }

            var element = document.getElementById("order-btn");
            if (element.classList.contains("fa-sort-numeric-asc")) {
                element.classList.remove("fa-sort-numeric-asc");
                element.classList.add("fa-sort-numeric-desc");
            } else {
                element.classList.add("fa-sort-numeric-asc");
                element.classList.remove("fa-sort-numeric-desc");
            }
        }
    @endsection

    @include('layouts.comments', [
        'page_identifier' => 'animes-' . $anime->id
    ])
@endsection