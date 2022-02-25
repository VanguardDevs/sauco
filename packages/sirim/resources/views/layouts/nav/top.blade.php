<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed">
<!-- begin:: Header Menu -->
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper"></div>
<!-- end:: Header Menu -->
<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">
    <!--begin: User Bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
            <div class="kt-header__topbar-user">
                <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->full_name }}</span>
                <img class="kt-image" alt="Pic" src="{{ asset('uploads/users/'.Auth::user()->avatar) }}"/>
            </div>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
        <!--begin: Navigation -->
            <div class="kt-notification">
                <div class="kt-notification__custom kt-space-between">
                    <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                </div>
            </div>
        <!--end: Navigation -->
        </div>
    </div>
    <!--end: User Bar -->
</div>
<!-- end:: Header Topbar -->
</div>
