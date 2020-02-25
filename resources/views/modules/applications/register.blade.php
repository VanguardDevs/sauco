@extends('cruds.form')

@section('title', 'Aprobar licencia 2020')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Realizar solicitud
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                    {!! Form::open(['route' => ["applications", $taxpayer->id], 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('taxpayers') }}" class="btn btn-danger" id="cancel"><i class="fas fa-cancel"></i>Cancelar</a>
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
