<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
  <!-- begin:: Aside -->
<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
  <div class="kt-aside__brand-logo">
    <a href="{{ url('dashboard') }}">
      <img alt="Logo" class="logo" src="{{ asset('assets/images/logo1.png') }}"/>
    </a>
  </div>

  <div class="kt-aside__brand-tools">
    <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
    </g>
</svg></span>
        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero"/>
        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
    </g>
</svg></span>
      </button>
      <!--
      <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
      -->
    </div>
  </div>
<!-- end:: Aside -->  <!-- begin:: Aside Menu -->
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">

  <div
    id="kt_aside_menu"
    class="kt-aside-menu "
    data-ktmenu-vertical="1"
     data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500"
    >

    <ul class="kt-menu__nav ">
        <li class="kt-menu__item {{ active('dashboard') }}" aria-haspopup="true" >
            <a  href="{{ url('dashboard') }}" class="kt-menu__link">
            <i class="kt-menu__link-icon flaticon-home"></i>
            <span class="kt-menu__link-text">Inicio</span>
            </a>
        </li>

        @if(@Auth::user()->hasRole('admin'))
            <li class="kt-menu__item {{ active('representations*') }}" aria-haspopup="true" >
                <a  href="{{ url('representations') }}" class="kt-menu__link">
                <i class="kt-menu__link-icon flaticon-users"></i>
                <span class="kt-menu__link-text">Representantes</span>
                </a>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu {!! classActivePath('taxpayers') !!}" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
                <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon-network "></i>
                    <span class="kt-menu__link-text">Contribuyentes</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item {{ active('taxpayers*') }}" aria-haspopup="true" >
                            <a  href="{{ url('taxpayers') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Registro</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu {!! classActivePath('properties') !!}" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
                <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-position"></i>
                    <span class="kt-menu__link-text">Inmuebles</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item {{ active('properties*') }}" aria-haspopup="true" >
                            <a  href="{{ url('properties') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">Listado</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item {{ active('economic-activities*') }}" aria-haspopup="true" >
                <a  href="{{ url('economic-activities') }}" class="kt-menu__link">
                <i class="kt-menu__link-icon flaticon-coins"></i>
                <span class="kt-menu__link-text">Actividades económicas</span>
                </a>
            </li>

            <li class="kt-menu__item {{ active('applications*') }}" aria-haspopup="true" >
                <a  href="{{ url('applications') }}" class="kt-menu__link">
                <i class="kt-menu__link-icon flaticon-paper-plane-1"></i>
                <span class="kt-menu__link-text">Solicitudes</span>
                </a>
            </li>

            <li class="kt-menu__item {{ active('fines*') }}" aria-haspopup="true" >
                <a  href="{{ url('fines') }}" class="kt-menu__link">
                <i class="kt-menu__link-icon flaticon-warning-sign"></i>
                <span class="kt-menu__link-text">Multas</span>
                </a>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu {!! classActivePath('geographic-area') !!}" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
                <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon-earth-globe "></i>
                    <span class="kt-menu__link-text">Área geográfica</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item {{ active('geographic-area/parishes*') }}" aria-haspopup="true" >
                            <a  href="{{ url('geographic-area/parishes') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Parroquias</span>
                            </a>
                        </li>

                        <li class="kt-menu__item {{ active('geographic-area/communities*') }}" aria-haspopup="true" >
                            <a  href="{{ url('geographic-area/communities') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Comunidades</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu {!! classActivePath('administration') !!}" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
                <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon-user-settings"></i>
                    <span class="kt-menu__link-text">Administración</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                    <li class="kt-menu__item {{ active('administration/permissions*') }}" aria-haspopup="true" >
                        <a  href="{{ url('administration/permissions') }}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                        <span class="kt-menu__link-text">Permisos</span>
                        </a>
                    </li>

                    <li class="kt-menu__item {{ active('administration/roles*') }}" aria-haspopup="true" >
                        <a  href="{{ url('administration/roles') }}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                        <span class="kt-menu__link-text">Roles</span>
                        </a>
                    </li>

                    <li class="kt-menu__item {{ active('administration/users*') }}" aria-haspopup="true" >
                        <a  href="{{ url('administration/users') }}" class="kt-menu__link ">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                        <span class="kt-menu__link-text">Usuarios</span>
                        </a>
                    </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu {!! classActivePath('settings') !!}" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
                <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon-settings"></i>
                    <span class="kt-menu__link-text">Configuraciones</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item {{ active('settings/tax-units*') }}" aria-haspopup="true" >
                            <a  href="{{ url('settings/tax-units') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Unidades tributarias</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ active('settings/property-types*') }}" aria-haspopup="true" >
                            <a  href="{{ url('settings/property-types') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Clasificador de inmuebles</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ active('settings/economic-sectors*') }}" aria-haspopup="true" >
                            <a  href="{{ url('settings/economic-sectors') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Sectores económicos</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ active('settings/application-types*') }}" aria-haspopup="true" >
                            <a  href="{{ url('settings/application-types') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Tipos de solicitudes</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ active('settings/charging-methods*') }}" aria-haspopup="true" >
                            <a  href="{{ url('settings/charging-methods') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Métodos de cobro</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ active('settings/fine-types*') }}" aria-haspopup="true" >
                            <a  href="{{ url('settings/fine-types') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                            <span class="kt-menu__link-text">Tipos de multas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
  </div>
</div>
<!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->
