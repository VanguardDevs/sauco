@extends('layouts.template')

@push('js')
<script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush

@section('title', 'Ficha del Contribuyente '.$row->rif)

@section('content')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

  <!-- begin:: Subheader -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
      <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
      <h3 class="kt-subheader__title">
        Contribuyente #{{ $row->id }}
      </h3>
    </div>
    <div class="kt-subheader__toolbar">
      <div class="kt-subheader__wrapper">
        <a class="btn kt-subheader__btn-primary" href="{{ url('taxpayers') }}" title="Regresar">
          <i class='flaticon2-back'></i>
        </a>
        @if (Auth::user()->hasRole('admin'))        
        <a class="btn kt-subheader__btn-primary" href="{{ url()->current()."/edit" }}" title="Editar">
          <i class='flaticon-edit'></i>
        </a>
        @endif
        <!--
        <a class="btn kt-subheader__btn-primary" onClick="onClickAddFine()" data-toggle="modal" data-target="#kt_modal_2">
            <i class="flaticon-exclamation"></i>
        </a>
        -->
        @if (Auth::user()->hasRole('liquidator'))        
        <!--<a class="btn kt-subheader__btn-primary" onClick="onClickAddApplication()" data-toggle="modal" data-target="#kt_modal_1">
            <i class="flaticon-paper-plane"></i>
        </a> -->        
        <a class="btn kt-subheader__btn-primary" onClick="onClickCalculateSettlements({{ $row->id }})">
            <i class="flaticon-price-tag"></i>
        </a> 
        @endif        
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
              <div class="kt-widget__content">
                <div class="kt-widget__section">
                  <a href="#" class="kt-widget__username">
                    {{ $row->name }}
                  </a>
                  <span class="kt-widget__subtitle">
                    {{ $row->rif }}
                  </span>
                </div>
              </div>
            </div>
            <div class="kt-widget__body">
              <div class="kt-widget__content">
                <div class="kt-widget__info">
                    <span class="kt-widget__label">Denominación comercial:</span>
                    <span class="kt-widget__data">{{ $row->commercialDenomination->name  ?? 'NO REGISTRADO'}}</span>
                </div>
                <div class="kt-widget__info">
                    <span class="kt-widget__label">Sector económico:</span>
                    <span class="kt-widget__data">{{ $row->economicSector->description }}</span>
                </div>
                <div class="kt-widget__info">
                  <span class="kt-widget__label">Dirección:</span>
                  <span class="kt-widget__data">{{ $row->fiscal_address }}</span>
                </div>
                <div class="kt-widget__info">
                    <span class="kt-widget__label">Capital suscrito:</span>
                    <span class="kt-widget__data">{{ $row->capital ?? "NO REGISTRADO" }}</span>
                  </div>
                <div class="kt-widget__info">
                    <span class="kt-widget__label">Conformidad de uso:</span>
                    <span class="kt-widget__data">{{ $row->compliance_use ?? "NO REGISTRADO" }}</span>
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
            @if (($row->taxpayerType->description == 'JURÍDICO') || ($row->commercialDenomination))
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Actividades económicas</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            @if(!$row->economicActivities->count())
                            <a href="{{ url("taxpayer/".$row->id."/economic-activities/add") }}" class="btn btn-label-brand btn-bold btn-sm">Añadir</a>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget4">
                            @forelse($row->economicActivities as $activity) 
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__icon">
                                         <i class="flaticon2-percentage"></i>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a class="kt-widget4__username">
                                            {{ $activity->code }}
                                        </a>
                                        <p class="kt-widget4__text">
                                            {{ $activity->name  }}
                                        </p>
                                    </div>
                                </div>
                            @empty 
                                Este contribuyente no tiene actividades económicas asignadas
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @if ($row->licenses()->exists())
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Licencias</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget4">
                            @foreach ($row->licenses as $license)
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__info">
                                        <a href="{{ url("licenses/{$license->id}/download") }}">
                                            <p class="kt-widget4__title">Licencia por concepto de {{ $license->ordinance->description }}</p>
                                        </a>
                                    <span class="kt-widget4__sub">Emitida el día: {{ $license->emission_date }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Representante(s)</h3>
                        </div>
                        @if(Auth()->user()->hasRole('analyst'))
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{ url("taxpayers/".$row->id."/representation/create") }}" class="btn btn-label-brand btn-bold btn-sm">Añadir</a>
                        </div>
                        @endif
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget4">
                            @forelse ($row->representations as $representation)
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <img src="{{ asset('assets/images/user-default.png') }}" alt="" />
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a class="kt-widget4__username">
                                            {{ $representation->person->name }}
                                        </a>
                                        <p class="kt-widget4__text">
                                            {{ $representation->representationType->name  }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                Este contribuyente no tiene representante
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
       </div>
       @endif
    </div>
   <!--End:: App Content-->
  </div>
  <!--End::App-->
</div>
<!-- end:: Content -->
</div>
@endsection
