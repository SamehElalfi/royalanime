<div class="col-12 col-md-6 col-xl-3 ">
<div class="card shadow p-0 border-0 rounded overflow-hidden my-3">
    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4 lazy" style="background: linear-gradient(rgba(94, 114, 228, 0), rgba(23, 43, 77, 0.4));background-position: center;min-height: 200px;background-size: cover;" data-src="{{ $episode->animeDetails->image_url ?? '' }}">
        <div class="d-flex justify-content-between">
            <a href="seasons/{{ $episode->animeDetails->premiered ?? '' }}" class="btn btn-sm btn-info mr-4">
                {{ $episode->animeDetails->premiered ?? '' }}
            </a>
            <a href="status/{{ $episode->animeDetails->status ?? '' }}" class="btn btn-sm btn-default float-right">
                {{ $episode->animeDetails->status ?? '' }}
            </a>
        </div>
    </div>
    <div class="card-body px-2">
        <a href="animes/{{ $episode->anime_id ?? '' }}/episodes/{{ $episode->episode_number ?? '' }}">
            <h3 class="text-center h5" dir="ltr">
                {{ $episode->animeDetails->title ?? '' }}
            </h3>
        </a>
        
        <div class="text-center">
            <a href="animes/{{ $episode->anime_id ?? '' }}/episodes/{{ $episode->episode_number ?? '' }}">
                <div class="h5 font-weight-300" id="preview-tags">الحلقة {{$episode->episode_number}}</div>

                <hr class="my-2">
                مشاهدة الحلقة
            </a>
        </div>
    </div>
</div>
</div>