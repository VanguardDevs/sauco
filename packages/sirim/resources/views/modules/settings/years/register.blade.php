@extends('cruds.form')

@section('title', 'Nuevo año fiscal')

@section('form')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fas fa-lightbulb"></></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Nuevo año fiscal
                    </h3>
                </div>
            </div>
            <!--begin::Form-->
            {!! Form::open(['route' => "years".'.store', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
            <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Ingrese el año <span class="text-danger">*</span></label>

                                {!! Form::text('year', old('year', @$row->year), ['class' => 'form-control', "required"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('settings') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

                                    <button type="submit" class="btn btn-primary" id="send">
                                        <i class="fas fa-save"></i>
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
      <!--end::Form-->
        </div>
    <!--end::Portlet-->
    </div>
@endsection
