<!-- Main Navbar -->
<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
    <div class="container">
        <!-- Brand on Desktop ONLY -->
        <a class="navbar-brand mr-lg-5" href="/">
            <img alt="image" src="{{ asset('img/brand/white.png') }}">
        </a>

        <!-- Hamberger Menu -->
        <!-- Brand on Phones ONLY -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Pages -->
        <div class="navbar-collapse collapse" id="navbar_global">
            <!-- Navbar on Phones -->
            <!-- Note: This is not visible on Desktop -->
            <div class="navbar-collapse-header">
                <div class="row">

                    <!-- Brand on Phones ONLY -->
                    <!-- Note: This is not visible on Desktop -->
                    <div class="col-6 collapse-brand">
                        <a href="/">
                            <img alt="image" src="{{ asset('img/brand/blue.png') }}">
                        </a>
                    </div>

                    <!-- Close Button X on Phones -->
                    <!-- Note: This is not visible on Desktop -->
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Pages in Navbar -->
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                {{-- <li class="nav-item dropdown">

                    <!-- Page Name -->
                    <a href="/animes" class="nav-link" data-toggle="dropdown" role="button">
                        <i class="ni ni-ui-04 d-lg-none"></i>
                        <span class="nav-link-inner--text">أنمي</span>
                    </a>

                    <!-- Page content -->
                    <!-- NOTE: This content will be hidden till a user hover on Page Name -->
                    <div class="dropdown-menu dropdown-menu-xl">
                        <div class="dropdown-menu-inner">

                            <a href="#new-anime" class="media d-flex align-items-center">
                                <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                                    <i class="ni ni-spaceship"></i>
                                </div>
                                <div class="media-body ml-3">
                                    <h6 class="heading text-primary mb-md-1">جديد الأنمي</h6>
                                    <p class="description description-content d-none d-md-inline-block mb-0">تابع أحدث حلقات الأنميات الجديدة، عشرات الحلقات الجديدة كل يوم.</p>
                                </div>
                            </a>

                            <a href="/animes" class="media d-flex align-items-center">
                                <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                    <i class="ni ni-align-left-2"></i>
                                </div>
                                <div class="media-body ml-3">
                                    <h6 class="heading text-primary mb-md-1">قائمة الأنمي</h6>
                                    <p class="description description-content d-none d-md-inline-block mb-0">تريد أن تشاهد مسلسل آخر. أبحث في قائمة الأنمي بين مئات المسلسلات الممتعة.</p>
                                </div>
                            </a>

                            <a href="#" class="media d-flex align-items-center">
                                <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                                    <i class="ni ni-delivery-fast"></i>
                                </div>
                                <div class="media-body ml-3">
                                    <h5 class="heading text-warning mb-md-1">أطلب أنمي</h5>
                                    <p class="description description-content d-none d-md-inline-block mb-0">أطلب أي أنمي تريده، وسوف نقوم بترجمته ورفعه على سيرفراتنا للمشاهدة والتحميل مجانًا.</p>
                                </div>
                            </a>

                            <a href="#" class="media d-flex align-items-center">
                                <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                                    <i class="ni ni-ui-04"></i>
                                </div>
                                <div class="media-body ml-3">
                                    <h6 class="heading text-primary mb-md-1">تصنيفات الأنمي</h6>
                                    <p class="description description-content d-none d-md-inline-block mb-0">شاهد وحمل الأنميات بحسب تصنيفها. أكثر من 30 تصنيف مختلف.</p>
                                </div>
                            </a>

                        </div>
                    </div>
                </li> --}}

                {{-- <li class="nav-item dropdown">

                    <!-- Page Name -->
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                        <i class="ni ni-collection d-lg-none"></i>
                        <span class="nav-link-inner--text">أفلام</span>
                    </a>

                    <!-- Page Content -->
                    <div class="dropdown-menu">
                        <a href="examples/profile.html" class="dropdown-item description-content">أحدث الأفلام</a>
                        <a href="examples/landing.html" class="dropdown-item description-content">قائمة الأفلام</a>
                        <a href="examples/login.html" class="dropdown-item description-content">التصنيفات</a>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <!-- Page Name -->
                    <a href="/animes" class="nav-link" role="button">
                        <i class="ni ni-collection d-lg-none"></i>
                        <span class="nav-link-inner--text">أنمي</span>
                    </a>
                    <!-- NOTE: This page has not any PAGE CONTENT -->
                </li>

                <li class="nav-item">
                    <!-- Page Name -->
                    <a href="/legal/contact" class="nav-link" role="button">
                        <i class="ni ni-collection d-lg-none"></i>
                        <span class="nav-link-inner--text">تواصل معنا</span>
                    </a>
                    <!-- NOTE: This page has not any PAGE CONTENT -->
                </li>
            </ul>

            <!-- Social Media Page and Search Button -->
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" title="Like us on Facebook">
                        <i class="fa fa-facebook-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Facebook</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" title="Follow us on Instagram">
                        <i class="fa fa-instagram"></i>
                        <span class="nav-link-inner--text d-lg-none">Instagram</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank" data-toggle="tooltip" title="Follow us on Twitter">
                        <i class="fa fa-twitter-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Twitter</span>
                    </a>
                </li>

                <!-- Search Button -->
                <!-- NOTE: This button will be visible till a user clicks on it -->
                <!-- Then SEARCH FIELD will replace it -->
                <li class="nav-item d-none d-lg-block ml-lg-4 color-primry searchbtn" id='searchbtn'>
                    <a target="_blank" class="btn btn-neutral btn-icon">
                        <span class="btn-inner--icon">
                            <i class="fa fa-search mr-2"></i>
                        </span>
                        <span class="nav-link-inner--text">بحث</span>
                    </a>
                </li>

                <!-- Search Field -->
                <!-- NOTE: This field will be hidden till a user clicks on SEARCH BUTTON -->
                <!-- If the user clicks outside the field, SEARCH FIELD will return hidden -->
                <!-- And SEARCH BUTTON will return visible -->
                <li class="nav-item d-sm-block d-lg-none ml-lg-4 color-primry searchfield" id='searchfield'>
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in color-primry"></i></span>
                    </div>
                    <input class="form-control" placeholder="بحث" type="text" autofocus>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>