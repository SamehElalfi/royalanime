<div
 class="card card-profile shadow mb-5 anime-card"
 style="background-origin: border-box;background-image: linear-gradient(rgba(94, 114, 228, 0.3), rgba(23, 43, 77, 0.3)), url({{ $anime->cover_url != '' ? $anime->cover_url : $anime->image_url }});color: #fff;border-radius: 10px;margin-top: 0;">
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
                    <a href="/tags/{{$gener}}" class="btn btn-sm btn-default float-right mx-1">{{$gener}}</a>
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
                                <h3 style="color: #fff;">{{$anime->title}}</h3>
                            </div>
                            <p
                            class="fz-sm-1 text-white p-4"
                            style="background: rgba(23, 43, 77, 0.5);border-radius: 15px;">
                            {{$anime->arabic_synopsis}}
                            </p>
                        </div>
                        <div class="col-md-3 mt-md-5 d-md-none d-lg-block d-sm-none">
                            <a href="animes/{{$anime->id}}">
                                <img src="{{$anime->image_url}}" class="d-sm-hidden img-fluid rounded shadow" alt="{{$anime->title}}">
                            </a>
                        </div>
                    </div>
                    <a href="/animes/{{$anime->id}}" class="btn btn-lg btn-primary">مشاهدة وتحميل الأنمي</a>
                </div>
            </div>
        </div>
    </div>
</div>