<!-- SlideShow -->
<div class="col-lg-7 mb-lg-auto pr-md-0">
    <div class="rounded shadow-lg overflow-hidden transform-perspective-right">
        <div id="carousel_example" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel_example" data-slide-to="0" class="active"></li>
                <li data-target="#carousel_example" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                @foreach ($images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <a href="{{$image['link'] ?? ''}}"><img class="img-fluid sm lazy" data-src="{{cdn($image['src']) ?? ''}}" alt="{{$image['alt'] ?? ''}}"></a>
                    </div>
                @endforeach
            </div>
            <span class="cursor-pointer carousel-control-prev h1" href="#carousel_example" role="button" data-slide="prev">
                <span class="text-dark fa fa-angle-right carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </span>
            <span class="cursor-pointer carousel-control-next h1" href="#carousel_example" role="button" data-slide="next">
                <span class="text-dark fa fa-angle-left carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </span>
        </div>
    </div>
</div>