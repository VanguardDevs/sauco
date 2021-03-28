<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " >
  <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
  <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper"></div>
  <div class="kt-header__topbar">
    <div class="kt-header__topbar-item kt-header__topbar-item--user">    
      <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
        <div class="kt-header__topbar-user">
          <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
          <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }}</span>
          <img class="kt-badge--rounded" alt="Pic" src="{{ asset(Auth::user()->avatar) }}" />
        </div>
      </div>
      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
        <div class="kt-notification">
          <a href="#" class="kt-notification__item"> 
            <div class="kt-notification__item-details">
              <div class="kt-notification__item-title kt-font-bold">
                My Profile
              </div>
            </div>
          </a>
          <div class="kt-notification__custom kt-space-between">
            <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>