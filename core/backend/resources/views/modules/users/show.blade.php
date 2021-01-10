@extends('layouts.template')

@section('title', Auth::user()->login)

@section('content')
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">Perfil de usuario</h3>
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total">{{ Auth::user()->login }}</span>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                {!! Form::open(['url' => 'update-profile', 'class' => 'kt-form kt-form--label-right', 'method' => 'put', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Nombre</label>
                                {!! Form::text("name", old('name', Auth::user()->employee->first_name), ["readonly", "class" => "form-control"]) !!}
                            </div>

                            <div class="col-lg-4">
                                <label>Apellido</label>
                                {!! Form::text("surname", old('surname', Auth::user()->employee->surname), ["readonly", "class" => "form-control"]) !!}
                            </div>

                            <div class="col-lg-4">
                                <label>Usuario</label>
                                {!! Form::text("login", old('login', Auth::user()->login), ["readonly", "class" => "form-control"]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" autofocus>
                            </div>
                        </div>      
                    </div>
                    <div class="kt-portlet__foot">
                      <div class="kt-form__actions">
                        <div class="row">
                          <div class="col-lg-6">        
                              <button type="submit" class="btn btn-primary">
                                    <i class="flaticon-refresh"></i>
                                    Actualizar
                              </button>
                          </div>
                        </div>
                      </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection