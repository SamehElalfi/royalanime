@extends('dashboard.layouts.app', ['title' => __('dashboard.Advanced Settings')])

@section('content')
    @include('dashboard.users.partials.header', [
        'title' => 'الإعدادات المتقدمة',
        'description' => 'قم بحفظ نسخة إحتياطية من قاعدة البيانات قبل تغيير أي شيء هنا',
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            {{-- Left Side Bar --}}
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-body pt-0 pt-md-4">
                        <div class="text-center">
                            <h3>
                                ملفات Sitemap.xml
                            </h3>
                            <div class="h5 font-weight-300">
                                <p>خريطة الموقع (sitemap) هي عدد من صفحات موقع على شبكة الإنترنت في متناول المستخدمين أو المتصفحين. فإنه يمكن أن يكون إما مستند في أي شكل من الأشكال المستخدمة كأداة للتخطيط لتصميم مواقع الإنترنت، أو صفحة على شبكة الإنترنت تسرد الصفحات الموجودة على الموقع، التي تنظم عادة في شكل شجري. وهذا يساعد الزوار ومحرك البحث بوت (bot) لإيجاد الصفحات على الموقع.</p>
                                <a href="https://ar.wikipedia.org/wiki/%D8%AE%D8%B1%D9%8A%D8%B7%D8%A9_%D8%A7%D9%84%D9%85%D9%88%D9%82%D8%B9">
                                    {{ __('dashboard.Show more') }}
                                </a>
                            </div>
                            <hr class="my-7">
                            <h3>
                                ملفات Robots.txt
                            </h3>
                            <div class="h5 font-weight-300">
                                <p>
                                    معيار استبعاد الروبوتات ويعرف باسم آخر وهو بروتكول استبعاد الروبوتات (بالإنجليزية: Robots exclusion standard أو robots exclusion protocol أو ببساطة robots.txt)‏ وهو معيار يستخدم بواسطة أي موقع ويب للاتصال بزاحف الشبكة Web crawler أو أي روبوت موقع آخر، يحدد المعيار كيفية إبلاغ أي روبوت على شبكة الإنترنت عن الأماكن التي لا ينبغي أن تتم معالجتها أو المناطق التي لا يجب معرفتها، الروبوتات تستخدم بواسطة محركات البحث لكي تستطيع عمل تصنيف للمواقع، ليس كل الروبوتات تتعاون مع المعايير والمقاييس الدولية مثل حصاد البريد الإلكتروني وسبام بوت والبرمجيات الخبيثة، والروبوتات التي تبحث عن وتفحص الثغرات الأمنية، معيار استبعاد الروبوتات مقترن دائما بخريطة الموقع
                                </p>
                                <a href="https://ar.wikipedia.org/wiki/%D9%85%D8%B9%D9%8A%D8%A7%D8%B1_%D8%A7%D8%B3%D8%AA%D8%A8%D8%B9%D8%A7%D8%AF_%D8%A7%D9%84%D8%B1%D9%88%D8%A8%D9%88%D8%AA%D8%A7%D8%AA">
                                    {{ __('dashboard.Show more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    
                    @if (\Session::has('main'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ \Session::get('main') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('dashboard.Advanced Settings') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- Sitemap Settings --}}
                        <form method="post" action="{{ route('settings.advanced') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('dashboard.Sitemap Settings') }}</h6>
                            
                            @if (\Session::has('sitemap'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ \Session::get('sitemap') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            
                            <div class="pl-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" name="all-sitemaps" id="all-sitemaps" type="checkbox">
                                    <label class="custom-control-label" for="all-sitemaps">
                                        <span class="{{ $errors->has('all-sitemaps') ? 'text-danger' : 'text-muted' }}">{{ __('dashboard.Update All Sitemaps') }}</span>
                                    </label>
                                </div>
                                <div class="form-group{{ $errors->has('all-sitemaps') ? ' has-danger' : '' }}">
                                    @if ($errors->has('all-sitemaps'))
                                        <span class="h5 text-danger" role="alert">
                                            <strong>{{ $errors->first('all-sitemaps') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" name="animes-sitemaps" id="animes-sitemaps" type="checkbox">
                                    <label class="custom-control-label" for="animes-sitemaps">
                                        <span class="{{ $errors->has('animes-sitemaps') ? 'text-danger' : 'text-muted' }}">{{ __('dashboard.Update Animes Sitemaps') }}</span>
                                    </label>
                                </div>
                                <div class="form-group{{ $errors->has('animes-sitemaps') ? ' has-danger' : '' }}">
                                    @if ($errors->has('animes-sitemaps'))
                                        <span class="h5 text-danger" role="alert">
                                            <strong>{{ $errors->first('animes-sitemaps') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" name="episodes-sitemaps" id="episodes-sitemaps" type="checkbox">
                                    <label class="custom-control-label" for="episodes-sitemaps">
                                        <span class="{{ $errors->has('episodes-sitemaps') ? 'text-danger' : 'text-muted' }}">{{ __('dashboard.Update Episodes Sitemaps') }}</span>
                                    </label>
                                </div>
                                <div class="form-group{{ $errors->has('episodes-sitemaps') ? ' has-danger' : '' }}">
                                    @if ($errors->has('episodes-sitemaps'))
                                        <span class="h5 text-danger" role="alert">
                                            <strong>{{ $errors->first('episodes-sitemaps') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" name="pages-sitemaps" id="pages-sitemaps" type="checkbox">
                                    <label class="custom-control-label" for="pages-sitemaps">
                                        <span class="{{ $errors->has('pages-sitemaps') ? 'text-danger' : 'text-muted' }}">{{ __('dashboard.Update Pages Sitemaps') }}</span>
                                    </label>
                                </div>
                                <div class="form-group{{ $errors->has('pages-sitemaps') ? ' has-danger' : '' }}">
                                    @if ($errors->has('pages-sitemaps'))
                                        <span class="h5 text-danger" role="alert">
                                            <strong>{{ $errors->first('pages-sitemaps') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" name="blog-sitemaps" id="blog-sitemaps" type="checkbox">
                                    <label class="custom-control-label" for="blog-sitemaps">
                                        <span class="{{ $errors->has('blog-sitemaps') ? 'text-danger' : 'text-muted' }}">{{ __('dashboard.Update Blog Sitemaps') }}</span>
                                    </label>
                                </div>
                                <div class="form-group{{ $errors->has('blog-sitemaps') ? ' has-danger' : '' }}">
                                    @if ($errors->has('blog-sitemaps'))
                                        <span class="h5 text-danger" role="alert">
                                            <strong>{{ $errors->first('blog-sitemaps') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" name="main-sitemaps" id="main-sitemaps" type="checkbox">
                                    <label class="custom-control-label" for="main-sitemaps">
                                        <span class="{{ $errors->has('main-sitemaps') ? 'text-danger' : 'text-muted' }}">{{ __('dashboard.Update Main Sitemap') }}</span>
                                    </label>
                                </div>
                                <div class="form-group{{ $errors->has('main-sitemaps') ? ' has-danger' : '' }}">
                                    @if ($errors->has('main-sitemaps'))
                                        <span class="h5 text-danger" role="alert">
                                            <strong>{{ $errors->first('main-sitemaps') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('dashboard.Update') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('settings.advanced') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('dashboard.Edit robots.txt file') }}</h6>
                            <p class="bg-warning text-white p-3 mb-4 text-center rounded">
                                <i class="fa fa-exclamation-triangle mx-3"></i>
                                تحذير: إستخدم هذه الإعدادات بحذر! أي أخطاء في هذا الملف قد يحجب الموقع عن محركات البحث بالكامل.
                            </p>
                            @if (\Session::has('robots'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ \Session::get('robots') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <textarea id="robots-updated" autocomplete="false" class="form-control form-control-alternative" dir="ltr" required="" rows="4" spellcheck="false" onchange="this.name='robots'"></textarea>
                                    <script>document.getElementById('robots-updated').value = `{{ $robots ?? '' }}`</script>
                                </div>
                               <input type="hidden" value="1" name="robots-updated">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('dashboard.Update') }}</button>
                                </div>
                            </div>
                            <div class="float-right">
                                <form method="post" action="{{ route('settings.advanced') }}">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" value="1" name="robots-default">
                                    <button type="submit" class="btn btn-default mt-4">{{ __('dashboard.Default') }}</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('dashboard.layouts.footers.auth')
    </div>
@endsection 