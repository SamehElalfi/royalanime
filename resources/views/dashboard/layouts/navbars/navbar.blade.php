@auth()
    @include('dashboard.layouts.navbars.navs.auth')
@endauth
    
@guest()
    @include('dashboard.layouts.navbars.navs.guest')
@endguest