<div class="blog-slider__content blog-post row row-grid mx-5 my-5 pb-5 px-5">
    <div class="blog-post__img col-md-4 col-sm-12 px-0">
        <img src="{{ cdn($post['feature_image']) }}" alt="{{ $post['title'] }}" title="{{ $post['title'] }}">
    </div>
    <div class="col-md-8">
        <span class="blog-slider__code">{{ $post["created_at"] }}</span>
        <div class="blog-slider__title">
            <a href="blog/posts/{{$post['id']}}/{{ $post['slug'] ?? $post['title'] }}" title="شاهد باقي المقالة">
                {{ $post['title'] }}
            </a>
        </div>
        <div class="blog-slider__text">{{ $post['summary'] }}</div>
        <a href="{{ route('posts.show', $post['id'].'/'.($post['slug'] ? $post['slug'] : $post['title'])) }}" class="blog-slider__button" title="شاهد باقي المقالة">
            أقرأ المزيد
        </a>
    </div>
</div>