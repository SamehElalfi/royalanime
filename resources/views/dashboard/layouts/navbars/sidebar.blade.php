<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white d-md-none" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ cdn('img/brand/blue.webp') }}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    @can('change settings')
                        <a href="/settings" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>{{ __('dashboard.Settings') }}</span>
                        </a>
                    @endcan
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ cdn('img/brand/blue.webp') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('dashboard.Dashboard') }}
                    </a>
                </li>
                
                {{-- Animes Managements --}}
                @canany('add animes', 'edit animes', 'delete animes', 'activate animes')
                    <li class="nav-item">
                        <a class="nav-link active collapsed" href="#navbar-animes" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fa fa-chess-knight text-blue"></i>
                            <span class="nav-link-text text-blue">{{ __('dashboard.Anime Management') }}</span>
                        </a>
                        
                        <div class="collapse" id="navbar-animes">
                            <ul class="nav nav-sm flex-column">

                                @can('add animes')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('animes.create') }}">
                                            <i class="fa fa-folder-plus"></i>
                                            {{ __('dashboard.Add Anime') }}
                                        </a>
                                    </li>
                                @endcan

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.animes.list') }}">
                                        <i class="fa fa-layer-group"></i>
                                        {{ __('dashboard.Anime List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcanany

                {{-- Episodes Management --}}
                @canany('edit episodes', 'add episodes', 'delete episodes', 'activate episodes')
                    <li class="nav-item">
                        <a class="nav-link active collapsed" href="#navbar-episodes" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fa fa-play text-green"></i>
                            <span class="nav-link-text text-green">{{ __('dashboard.Episodes Management') }}</span>
                        </a>
                        
                        <div class="collapse" id="navbar-episodes">
                            <ul class="nav nav-sm flex-column">

                                @can('add episodes')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('settings.episodes.create') }}">
                                            <i class="fa fa-folder-plus"></i>
                                            {{ __('dashboard.Add Episode') }}
                                        </a>
                                    </li>
                                @endcan

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.episodes.list') }}">
                                        <i class="fa fa-layer-group"></i>
                                        {{ __('dashboard.Episodes List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcanany

                
                {{-- Posts Management --}}
                @canany('edit posts', 'add posts', 'delete posts', 'activate posts')
                    <li class="nav-item">
                        <a class="nav-link active collapsed" href="#navbar-posts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-pen text-info"></i>
                            <span class="nav-link-text text-info">{{ __('dashboard.Posts Management') }}</span>
                        </a>
                        
                        <div class="collapse" id="navbar-posts">
                            <ul class="nav nav-sm flex-column">

                                @can('add posts')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('posts.create') }}">
                                            <i class="fa fa-folder-plus"></i>
                                            {{ __('dashboard.Add Post') }}
                                        </a>
                                    </li>
                                @endcan

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.posts.list') }}">
                                        <i class="fa fa-layer-group"></i>
                                        {{ __('dashboard.Posts List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcanany

                {{-- Users Management --}}
                @canany('edit users', 'add users', 'delete users', 'activate users')
                    <li class="nav-item">
                        <a class="nav-link active collapsed" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fa fa-users" style="color: #f4645f;"></i>
                            <span class="nav-link-text" style="color: #f4645f;">{{ __('dashboard.User Management') }}</span>
                        </a>
                        
                        <div class="collapse" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.edit') }}">
                                        <i class="fa fa-id-card"></i>
                                        {{ __('dashboard.User profile') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">
                                        <i class="fa fa-user-edit"></i>
                                        {{ __('dashboard.User Management') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcanany
                
                
                @can('change settings')
                    <li class="nav-item">
                        <a class="nav-link active collapsed text-gray" href="#navbar-settings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-settings">
                            <i class="fa fa-cogs"></i>
                            <span class="nav-link-text">{{ __('dashboard.Settings') }}</span>
                        </a>

                        
                        <div class="collapse" id="navbar-settings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.animes') }}">
                                        <i class="fa fa-chess-knight"></i>
                                        {{ __("dashboard.Anime Settings") }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.episodes') }}">
                                        <i class="fa fa-play"></i>
                                        {{ __("dashboard.Episodes Settings") }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.blog') }}">
                                        <i class="fa fa-bold"></i>
                                        {{ __("dashboard.Blog Settings") }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.comments') }}">
                                        <i class="fa fa-comments"></i>
                                        {{ __("dashboard.Comments Settings") }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.frontend') }}">
                                        <i class="fa fa-palette"></i>
                                        {{ __("dashboard.Frontend Settings") }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.social') }}">
                                        <i class="fa fa-thumbs-up"></i>
                                        {{ __("dashboard.Social Settings") }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.backup') }}">
                                        <i class="fa fa-database"></i>
                                        {{ __("dashboard.Backup Settings") }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.users') }}">
                                        <i class="fa fa-users-cog"></i>
                                        {{ __("dashboard.Users Settings") }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings.advanced') }}">
                                        <i class="fa fa-wrench"></i>
                                        {{ __("dashboard.Advanced Settings") }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">صفحات أخرى</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> أبدأ من هنا
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> عروض
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> المتجر
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>