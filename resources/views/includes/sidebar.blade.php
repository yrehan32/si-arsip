<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="/assets/images/logo-icon-2.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SiARSIP</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <ion-icon name="menu-sharp"></ion-icon>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class=" {{ in_array(Route::currentRouteName(), ['web.arsip-surat.list','web.arsip-surat.create','web.arsip-surat.show']) ? 'mm-active' : '' }} ">
            <a href="{{ route('web.arsip-surat.list') }}">
                <div class="parent-icon">
                    <i class="bi bi-star"></i>
                </div>
                <div class="menu-title">Arsip</div>
            </a>
        </li>
        <li class=" {{ Route::currentRouteName() == 'web.about' ? 'mm-active' : '' }} ">
            <a href="{{ route('web.about') }}">
                <div class="parent-icon">
                    <i class="bi bi-info-circle"></i>
                </div>
                <div class="menu-title">About</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>