<div class="col-12 col-md-6 col-xl-3 ">
<div class="card shadow p-0 border-0 rounded overflow-hidden my-3">
    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4 lazy" style="background: linear-gradient(rgba(94, 114, 228, 0.25), rgba(23, 43, 77, 0.66));background-position: center;min-height: 200px;background-size: cover;" data-src="{{ $episode->animeDetails->image_url }}">
        <div class="d-flex justify-content-between">
            <a href="seasons/{{ $episode->animeDetails->premiered }}" class="btn btn-sm btn-info mr-4">
                {{ $episode->animeDetails->premiered }}
            </a>
            <a href="status/{{ $episode->animeDetails->status }}" class="btn btn-sm btn-default float-right">
                {{ $episode->animeDetails->status }}
            </a>
        </div>
    </div>
    <div class="card-body px-2">
        <a href="animes/{{ $episode->mal_id }}/episodes/{{ $episode->episode_number }}">
            <h3 class="text-center h5" dir="ltr">
                {{ $episode->animeDetails->title }}
            </h3>
        </a>
                            
        <div class="text-center">
            <a href="animes/{{ $episode->mal_id }}/episodes/{{ $episode->episode_number }}">
                <div class="h5 font-weight-300" id="preview-tags">الحلقة {{$episode->episode_number}}</div>
                                
                <hr class="my-2">

                مشاهدة الحلقة
            </a>
        </div>
    </div>
</div>
</div>
{{-- <div
 class="card card-profile shadow mb-5 anime-card text-white lazy loading-img colored-bg mt-0 rounded-lg"
 data-src="{{ $anime->cover_url != '' ? $anime->cover_url : $anime->image_url }}">
    <div class="px-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-profile-stats d-flex justify-content-center">
                    <div class="info">
                        <span class="description">الموسم</span>
                        <span class="heading">{{$anime->premiered}}</span>
                    </div>
                    <div class="info">
                        <span class="heading">{{$anime->episodes ?? '?'}}</span>
                        <span class="description">حلقة</span>
                    </div>
                    <div class="info">
                        <span class="description">التقيم</span>
                        <span class="heading">{{$anime->score}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-profile-actions py-4 mt-0">
                    @foreach (json_decode($anime->genres) as $gener)
                    <a href="/tags/{{$gener}}" class="btn btn-sm btn-default float-none float-md-right mx-1">{{$gener}}</a>
                    @endforeach
                    <a href="/status/{{$anime->status}}" class="btn btn-sm btn-success float-right mx-1">{{$anime->status}}</a>
                </div>
            </div>
            
        </div>
        <div class="pt-1 pb-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="text-center mt-5" dir="ltr">
                                <a href="/animes/{{$anime->id}}/{{ Str::slug($anime->title, '-') ?? '' }}">
                                    <h3 class="text-white">
                                        {{$anime->title}}
                                    </h3>
                                </a>
                            </div>
                            <p
                            class="h6 text-white p-4"
                            style="background: rgba(23, 43, 77, 0.5);border-radius: 15px;">
                            {{$anime->arabic_synopsis}}
                            </p>
                        </div>
                        <div class="col-md-3 mt-md-5 d-md-none d-lg-block d-sm-none">
                            <a href="animes/{{$anime->id}}">
                                <img data-src="{{$anime->image_url}}" class="d-sm-hidden img-fluid rounded shadow lazy" alt="{{$anime->title}}">
                            </a>
                        </div>
                    </div>
                    <a href="/animes/{{$anime->id}}/{{ Str::slug($anime->title, '-') ?? '' }}" class="btn btn-lg btn-primary">مشاهدة وتحميل الأنمي</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}