@extends('dashboard.layouts.app', ['title' => __('setting.Main Settings')])

@section('content')
@include('dashboard.users.partials.header', [
    'title' => __('setting.Main Settings'),
    'description' => 'تحتوي هذه الصفحة على كل أنواع الإعدادات الخاصة بالموقع والمدونة والأنميات أيضاً',
])

    <div class="container-fluid mt--7">
        <div class="row">
            {{-- <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('users.Users') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('users.Add user') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('users.Name') }}</th>
                                    <th scope="col">{{ __('users.Email') }}</th>
                                    <th scope="col">{{ __('users.Creation Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if ($user->id != auth()->id())
                                                        <form action="{{ route('user.destroy', $user) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('user.edit', $user) }}">{{ __('users.Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('users.Delete') }}
                                                            </button>
                                                        </form>    
                                                    @else
                                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('users.Edit') }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div> --}}

            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.animes') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات الأنمي</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">إعدادات الأنمي</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fa fa-chess-knight"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">تعديل</span>
                                <span class="text-nowrap">صفحة المعلومات الخاصة بالأنمي</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.episodes') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات الحلقات</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">إعدادات الحلقات</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">إختيار السيرفرات</span>
                                <span class="text-nowrap">وطريقة عرض الحلقات</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.blog') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات المدونة</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">إعدادات المدونة</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fa fa-bold"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">كيفية ظهور التدوينات</span>
                                <span class="text-nowrap">وعرض الإشعارات</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.comments') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات التعليقات</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">إعدادات التعليقات</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gray text-white rounded-circle shadow">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">اختر نظام التعليقات</span>
                                <span class="text-nowrap">وغير إعداداته</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.frontend') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات التعليقات</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">إعدادات الواجهة</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                        <i class="fa fa-palette"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">إعدادات الشريط العلوي</span>
                                <span class="text-nowrap">وزيل الموقع</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.social') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات التعليقات</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">مواقع التواصل</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">تحكم في إمكانيات المشاركة</span>
                                <span class="text-nowrap">والصفحات الرسمية</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.backup') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات التعليقات</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">النسح الإحتياطي</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                        <i class="fa fa-database"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">تحكم في وقت النسخ</span>
                                <span class="text-nowrap">ومكان الحفظ</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.users') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات التعليقات</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">إعدادات المستخدمين</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">غير أدوار المستخدمين</span>
                                <span class="text-nowrap">وصلاحياتهم</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 my-md-4">
                <div class="card card-stats shadow mb-4 mb-xl-0">
                    <a href="{{ route('settings.advanced') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <h5 class="card-title text-uppercase text-muted mb-0">إعدادات التعليقات</h5> --}}
                                    <span class="h2 font-weight-bold mb-0">{{ __('dashboard.Advanced Settings') }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fa fa-toolbox"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success">إعدادات خطيرة</span>
                                <span class="text-nowrap">ومتقدمة</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>
            
        @include('dashboard.layouts.footers.auth')
    </div>
@endsection