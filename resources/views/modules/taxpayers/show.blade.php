@extends('layouts.template')

@push('js')
<script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush

@section('title', 'SIRIM | Ficha del Contribuyente')

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
        <a class="btn kt-subheader__btn-primary" href="{{ url()->current()."/edit" }}" title="Editar">
          <i class='flaticon-edit'></i>
        </a>
        <a class="btn kt-subheader__btn-primary" onClick="onClickAddFine()" data-toggle="modal" data-target="#kt_modal_2">
            <i class="flaticon-exclamation"></i>
        </a>
        <a class="btn kt-subheader__btn-primary" onClick="onClickAddApplication()" data-toggle="modal" data-target="#kt_modal_1">
            <i class="flaticon-paper-plane"></i>
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
                            @if ($row->economicActivities->count())
                            @foreach ($row->economicActivities as $activity)
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__title">{{ $activity->code }}</p>
                                        <span class="kt-widget4__sub">{{ $activity->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__info">
                                <span class="kt-widget4__sub">
                                    Este contribuyente no tiene actividades económicas asignadas
                                </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Representante(s)</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{ url("taxpayers/".$row->id."/representation/create") }}" class="btn btn-label-brand btn-bold btn-sm">Añadir</a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget-4">
                            @if($row->representations->count())
                            <table class="table table-bordered table-striped datatables">
                                <tr>
                                    <td>Cédula</td>
                                    <td>Nombre</td>
                                    <td>Posición</td>
                                </tr>
                                @foreach ($row->representations as $representation)
                                <tr>
                                    <td>{{ $representation->person->document }}</td>
                                    <td>{{ $representation->person->name }}</td>
                                    <td>{{ $representation->representationType->name }}</td>
                                </tr>
                                @endforeach
                            </table>
                            @else
                                Este contribuyente no tiene representante
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Licencias</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget-4">
                            @if(!is_null($row->licenses))
                                Este contribuyente no tiene licencia de actividad económica activa
                            @else
                            @foreach ($row->license as $license)
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__info">
                                        Licencia nº <a href="{{ url('economic-activity-license/'.$activity->id.'/'.$row->id) }}" class="kt-widget4__title">{{ $license->num }} | </a>
                                        <span class="kt-widget4__sub">Vigente desde {{ $activity->emission_date }}</span>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole('root'))
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Expendios</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{ url("taxpayer/".$row->id."/liqueurs/create") }}" class="btn btn-label-brand btn-bold btn-sm">Añadir</a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget-4">
                            @if ($row->properties->count())
                            <table class="table table-bordered table-striped datatables">
                                <tr>
                                    {{-- <td>Número catastral</td>
                                    <td>Calle</td>
                                    <td>No.</td>
                                    <td>Piso</td> --}}
                                </tr>
                                {{-- @foreach ($row->properties as $property)
                                    <tr>
                                        <td>{{ $property->cadastre_num }}</td>
                                        <td>{{ $property->street }}</td>
                                        <td>{{ $property->local }}</td>
                                        <td>{{ $property->floor }}</td>
                                    </tr>
                                @endforeach --}}
                            </table>
                            @else
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__info">
                                <span class="kt-widget4__sub">
                                    Este contribuyente no tiene licencias de licores registradas
                                </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if (Auth::user()->hasRole('root'))
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Inmuebles</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{ url("taxpayer/".$row->id."/property/create") }}" class="btn btn-label-brand btn-bold btn-sm">Añadir</a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget-4">
                            @if ($row->properties->count())
                            <table class="table table-bordered table-striped datatables">
                                <tr>
                                    <td>Número catastral</td>
                                    <td>Calle</td>
                                    <td>No.</td>
                                    <td>Piso</td>
                                </tr>
                                @foreach ($row->properties as $property)
                                    <tr>
                                        <td>{{ $property->cadastre_num }}</td>
                                        <td>{{ $property->street }}</td>
                                        <td>{{ $property->local }}</td>
                                        <td>{{ $property->floor }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__info">
                                <span class="kt-widget4__sub">
                                    Este contribuyente no tiene inmuebles registrados
                                </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
       @endif 
        <div class="row">
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Registro comercial</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            @if(is_null($row->commercialRegister))
                            <a href="{{ url("taxpayer/".$row->id."/commercial-register/create") }}" class="btn btn-label-brand btn-bold btn-sm">Añadir</a>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget-4">
                            @if(is_null($row->commercialRegister))
                            Este contribuyente no tiene registro comercial
                            @else
                            <table class="table table-bordered table-striped datatables">
                                <tr>
                                    <td>Número</td>
                                    <td>Tomo</td>
                                    <td>Expediente</td>
                                    <td>Fecha de inicio</td>
                                </tr>
                                <tr>
                                    <td>{{ $row->commercialRegister->num }}</td>
                                    <td>{{ $row->commercialRegister->volume }}</td>
                                    <td>{{ $row->commercialRegister->case_file }}</td>
                                    <td>{{ $row->commercialRegister->start_date }}</td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole('root'))
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Vehículos</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{ url("taxpayer/".$row->id."/vehicle/create") }}" class="btn btn-label-brand btn-bold btn-sm">Añadir</a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget-4">
                            @if ($row->vehicles->count())
                            @foreach ($row->vehicles as $vehicle)
                                <div class="kt-widget4__item">
                                <div class="kt-widget4__info">
                                    <p class="kt-widget4__title">{{ $vehicle->plate }}</p>
                                </div>
                                </div>
                            @endforeach
                            @else
                            <div class="kt-widget4__item">
                                <div class="kt-widget4__info">
                                <span class="kt-widget4__sub">
                                    Este contribuyente no tiene vehículo registrados
                                </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Solicitudes</h5>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'add-application-taxpayer', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                    <input type="hidden" value="{{ $row->id }}" name="taxpayer" />
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="control-label col-lg-12">Tipo de solicitud <span class="text-danger">*</span></label>
                                {!! Form::select("ordinance", [], "SELECCIONE", [
                                    "id" => "ordinance",
                                    "class" => "form-control select2 col-lg-12"
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="control-label col-lg-12">Concepto de recaudación <span class="text-danger">*</span></label>
                                {!!
                                    Form::select("concept", [], "SELECCIONE", [
                                        "id" => 'concepts',
                                        "class" => "form-control select2 col-lg-12"
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button  type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Registrar
                    </button>
                </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="kt_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de multa</h5>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'add-fine-taxpayer', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                    <input type="hidden" value="{{ $row->id }}" name="taxpayer" />
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Multa <span class="text-danger">*</span></label>
                                {!! Form::select("fine_type", [], "SELECCIONE", [
                                    "id" => "fine_types",
                                    "class" => "form-control select2"
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Observaciones</label>
                                {!! Form::textarea("description", old('description', @$row->description), ["placeholder" => "Observaciones", "class" => "form-control", "size" => "2x2", "onkeyup" => "upperCase(this);"]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button  type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Registrar
                    </button>
                </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!--End:: App Content-->
  </div>
  <!--End::App-->
</div>
<!-- end:: Content -->
</div>
@endsection
