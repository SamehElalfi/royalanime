<div class="text-center my-5 floating-sm">
    <span class="col col-12 col-md-4">{{ $title ?? 'شارك هذه الصفحة' }}</span>
    <div class="my-3 mx-3">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&amp;src=sdkpreparse" class="btn btn-primary btn-icon-only rounded-circle" rel="external nofollow">
            <i class="fa fa-facebook"></i>
        </a>
        <a target="_blank" href="https://twitter.com/intent/tweet?text=I%20love%20to%20share%20this%20amazing%20anime.%20I%20really%20recommend%20it.&amp;url={{ url()->current() }}" class="btn btn-primary btn-icon-only rounded-circle" rel="external nofollow">
            <i class="fa fa-twitter"></i>
        </a>
    </div>
</div>