<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
          <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
        @section('subheader__title')
        <h3 class="kt-subheader__title">
<!--            @yield('subheader_title'.'  ', '') -->
        </h3>
        @show

        <!-- Begin:: Breadcrumbs -->
        {{ Breadcrumbs::render() }}
        <!-- end:: Breadcrumbs --> 
    </div>
    <div class="kt-subheader__toolbar">
          <div class="kt-subheader__wrapper">
                <a class="btn kt-subheader__btn-primary" href="{{ url()->previous() }}" title="Regresar">
                  <i class='flaticon2-back'></i>
                </a>      
          </div>
    </div>
</div>
<!-- end:: Subheader -->
