@extends('layouts.template')

@section('title', 'Dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
    {{--<div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">{{ Auth::user()->first_name.' '.Auth::user()->surname }}</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>

            @foreach (Auth::user()->serviceStations as $item)
                {{ $item->description }}
            @endforeach
        </div>
    </div>--}}

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-exclamation-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        @if(@Auth::user()->hasRole('analyst'))
                            Validar Repostaje
                        @endif
                    </h3>
                </div>
            </div>

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    @if(@Auth::user()->hasRole('analyst'))
                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content">
                                {!! Form::open(['url' => 'validate-refuelling', 'autocomplete' => 'off', 'id' => 'form']) !!}
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="control-label"> Cédula de identidad <span class="text-danger">*</span></label>
                                                {!! Form::number("identity_card", null, ["required", "Placeholder" => "Cédula de identidad", "class" => "form-control", "autofocus"]) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="control-label"> Placa <span class="text-danger">*</span></label>
                                                {!! Form::text("license_plate", null, ["required", "Placeholder" => "Placa", "class" => "form-control", "onkeyup" => "upperCase(this);"]) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <button  type="submit" class="btn btn-primary" id="send">
                                                    <i class="flaticon flaticon-paper-plane-1"></i>
                                                    Enviar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!--end::Section-->
                    @elseif(@Auth::user()->hasRole('admin'))
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
