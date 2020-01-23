@extends('layouts.template')

@push('js')
<script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush

@section('title', 'SUMAT | Ficha del representante legal')

@section('content')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

  <!-- begin:: Subheader -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
      <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
      <h3 class="kt-subheader__title">
        Representante #{{ $row->id }}
      </h3>
    </div>
    <div class="kt-subheader__toolbar">
      <div class="kt-subheader__wrapper">
        <a class="btn kt-subheader__btn-primary" href="{{ url()->previous() }}" title="Regresar">
          <i class='flaticon2-back'></i>
        </a>
        <a class="btn kt-subheader__btn-primary" href="{{ url()->current()."/edit" }}" title="Editar">
          <i class='flaticon-edit'></i>
        </a>
      </div>
    </div>
  </div>
  <!-- end:: Subheader -->
  <!-- begin:: Content -->
  <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--Begin::App-->
  <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
    <!--Begin:: App Aside Mobile Toggle-->
    <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
      <i class="la la-close"></i>
    </button>
    <!--End:: App Aside Mobile Toggle-->

    <!--Begin:: App Aside-->
    <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
      <!--begin:: Widgets/Applications/User/Profile1-->
      <div class="kt-portlet kt-portlet--height-fluid-">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit-y">
          <!--begin::Widget -->
          <div class="kt-widget kt-widget--user-profile-1">
            <div class="kt-widget__head">
              <div class="kt-widget__media">
                <img src="uploads/users/user-admin.png" alt="image">
              </div>
              <div class="kt-widget__content">
                <div class="kt-widget__section">
                  <a href="#" class="kt-widget__username">
                    {{ $row->first_name." ".$row->second_name." ".$row->surname." ".$row->second_surname}}
                  </a>
                  <span class="kt-widget__subtitle">
                    {{ $row->document }}
                  </span>
                </div>
              </div>
            </div>
            <div class="kt-widget__body">
              <div class="kt-widget__content">
                <div class="kt-widget__info">
                  <span class="kt-widget__label">Dirección:</span>
                  <span class="kt-widget__data">{{ $row->address ?? "NO REGISTRADO" }}</span>
                </div>
                <div class="kt-widget__info">
                  <span class="kt-widget__label">Teléfono:</span>
                  <span class="kt-widget__data">{{ $row->phone ?? "NO REGISTRADO" }}</span>
                </div>
                <div class="kt-widget__info">
                  <span class="kt-widget__label">Correo:</span>
                  <span class="kt-widget__data">{{ $row->email ?? "NO REGISTRADO" }}</span>
                </div>
              </div>
            </div>
          </div>
          <!--end::Widget -->
        </div>
      </div>
      <!--end:: Widgets/Applications/User/Profile1-->
    </div>
    <!--End:: App Aside-->

    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
      <div class="row">
        <div class="col-xl-12">
          <!--begin:: Widgets/Tasks -->
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
              <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Contribuyentes</h3>
              </div>
              <div class="kt-portlet__head-toolbar">
                {{-- <a href="" class="btn btn-label-brand btn-bold btn-sm">Añadir</a> --}}
              </div>
            </div>
            <div class="kt-portlet__body">
              <div class="kt-widget-4">
                @if ($row->taxpayers->count())
                  @foreach ($row->taxpayers as $taxpayer)
                    <div class="kt-widget4__item">
                      <div class="kt-widget4__info">
                        <p class="kt-widget4__title">{{ $taxpayer->rif }}</p>
                      </div>
                    </div>
                  @endforeach
                @else
                  <div class="kt-widget4__item">
                    <div class="kt-widget4__info">
                      <span class="kt-widget4__sub">
                        Este representante no tiene contribuyentes asignados
                      </span>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end:: Widgets/Tasks -->
    </div>
    <!--End:: App Content-->
  </div>
  <!--End::App-->
</div>
<!-- end:: Content -->
</div>
@endsection
