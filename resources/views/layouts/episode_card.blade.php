<div class="col-12 col-md-6 col-xl-3 ">
<div class="card shadow p-0 border-0 rounded overflow-hidden my-3">
    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4 lazy" style="background: linear-gradient(rgba(94, 114, 228, 0), rgba(23, 43, 77, 0.4));background-position: center;min-height: 200px;background-size: cover;" data-src="{{ $episode->anime->image_url ?? '' }}">
        <div class="d-flex justify-content-between">
            @if ($episode->anime->premiered)
            <a href="seasons/{{ $episode->anime->premiered ?? '' }}" class="btn btn-sm btn-info mr-4">
                {{ $episode->anime->premiered ?? '' }}
            </a>
            @endif
            @if ($episode->anime->status)
            <a href="status/{{ $episode->anime->status ?? '' }}" class="btn btn-sm btn-default float-right">
                {{ $episode->anime->status ?? '' }}
            </a>
            @endif
        </div>
    </div>
    <div class="card-body px-2">
        <a href="animes/{{ $episode->anime_id ?? '' }}/episodes/{{ $episode->episode_number ?? '' }}">
            <h3 class="text-center h5" dir="ltr">
                {{ $episode->anime->title ?? '' }}
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