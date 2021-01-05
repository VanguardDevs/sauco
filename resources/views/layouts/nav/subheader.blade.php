<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            @yield('subheader__title')                    
        </h3>
        <span class="kt-subheader__separator kt-hidden"></span>
    </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <a href="{{ URL::previous() }}" class="btn btn-outline-success btn-bold" title="Regresar">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
        </div>
    </div>
</div>
