@extends('cruds.form')

@section('title', 'Cambiar contraseña')
@section('subheader__title', 'Cambiar contraseña')

@section('form')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
             <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Cambiar contraseña</h3>
                </div>
            </div>
           <!--begin::Form-->
            {!! Form::open(['route' => 'change-password.update', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Contraseña actual <span class="text-danger">*</span></label>
                        <input type="password" name="current-password" class="form-control" placeholder="Clave">

                        @error('current-password')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Nueva contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="new-password" class="form-control" placeholder="Clave">

                        @error('new-password')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Repita la contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="new-password_confirmation" class="form-control" placeholder="Clave">
                    </div>
                </div>
            </div>

            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ URL::previous() }}" class="btn btn-danger"><i class="flaticon-cancel"></i> Cancelar</a>

                            <button type="submit" class="btn btn-primary" id="send">
                                <i class="fas fa-save"></i>
                                Cambiar
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
</div>
@endsection
