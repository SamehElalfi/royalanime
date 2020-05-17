@extends('layouts.app')
@section('content')

    <!-- Latest Anime -->
    <section class="section section-components profile-page" id="section-components">
        <div class="container text-center">
            
            <!-- Section Title -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2 class="mb-5" id="new-anime">
                        <span>كل تصنيفات الأنمي</span>
                    </h2>
                </div>
            </div>

            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/إتشي">إتشي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/إثارة">إثارة</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/أكشن">أكشن</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/ألعاب">ألعاب</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/آلات">آلات</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/بوليسي">بوليسي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/تاريخي">تاريخي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/جنوني">جنوني</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/جوسي">جوسي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/حريم">حريم</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/خارق للطبيعة">خارق للطبيعة</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/خيال علمي">خيال علمي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/دراما">دراما</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/رعب">رعب</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/رومانسي">رومانسي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/رياضي">رياضي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/ساخر">ساخر</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/ساموراي">ساموراي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/سحر">سحر</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/سينن">سينن</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/شريحة من الحباة">شريحة من الحباة</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/شوجو">شوجو</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/شوجو">شوجو</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/شونين">شونين</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/شونين">شونين</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/شياطين">شياطين</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/طفولي">طفولي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/عسكري">عسكري</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/غموض">غموض</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/فانتازيا">فانتازيا</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/فضاء">فضاء</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/فنون">فنون</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/قوى خارقة">قوى خارقة</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/كوميدي ">كوميدي </a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/مدرسي">مدرسي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/مصاصي دماء">مصاصي دماء</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/مغامرات">مغامرات</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/موسيقي">موسيقي</a>
            <a class="btn btn-lg btn-outline-primary btn-round col col-5 col-md-2" href="/tags/نفسي">نفسي</a>

            <div class="text-center">
                {{-- <i class="fa fa-frown-o" style="font-size: 10em;"></i> --}}
                <p class="lead">هذه الصفحة لا تحتوي على أي أنميات، وإنما فقط كل تصنيفات الأنمي التي لدينا، يمكنك مشاهدة قائمة الأنميات أو البحث في أكثر من 40.000 حلقة لدينا.</p>
                <div class="btn-wrapper mt-5">
                    <a href="/animes" class="btn btn-lg btn-github btn-icon mb-3 mb-sm-0">
                        <span class="btn-inner--icon"><i class="fa fa-th-large"></i></span>
                        <span class="btn-inner--text">قائمة <span class="text-warning">الأنمي</span></span>
                    </a>
                    <a href="/search" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
                        <span class="btn-inner--icon"><i class="fa fa-television"></i></span>
                        <span class="btn-inner--text">أبحث في الموقع</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- Best Blogposts in a slidshow --}}
    @include('layouts.blog_section')

@endsection