<div
 class="card card-profile shadow mb-5 anime-card text-white lazy loading-img colored-bg mt-0 rounded-lg border-0"
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
                    @if ($anime->genres)
                        @foreach (json_decode($anime->genres) as $gener)
                        <a href="/tags/{{$gener}}" class="btn btn-sm btn-default float-none float-md-right mx-1">{{$gener}}</a>
                        @endforeach
                    @endif
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
                            @if ($anime->arabic_synopsis)
                                {!! substr($anime->arabic_synopsis, 0, 1000) !!} ...
                            @else
                                جاري العمل على قصة الأنمي.
                            @endif
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
</div>