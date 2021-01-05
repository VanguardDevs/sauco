@extends('cruds.form')

@if ($typeForm == 'create')
@section('title', 'Nuevo usuario')
@section('subheader__title', 'Nuevo usuario')
@else
@section('title', 'Actualizar usuarios')
@section('subheader__title', 'Actualizar usuario')
@endif

@section('form')
<div class="kt-portlet">
    <div class="row">
        <div class="col-lg-12">
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => 'users'.'.store', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ['users'.'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Cédula de Identidad <span class="text-danger">*</span></label>
                                {!! Form::number("identity_card", old('identity_card', @$row->identity_card), ["placeholder" => "Cédula de Identidad", "class" => "form-control"]) !!}

                                @error('identity_card')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Nombre <span class="text-danger">*</span></label>
                                {!! Form::text("first_name", old('first_name', @$row->first_name), ["placeholder" => "Nombre", "class" => "form-control" ])!!}

                                @error('first_name')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Apellido <span class="text-danger">*</span></label>
                                {!! Form::text("surname", old('surname', @$row->surname), ["placeholder" => "Apellido", "class" => "form-control"]) !!}

                                @error('surname')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Usuario <span class="text-danger">*</span></label>
                                {!! Form::text("login", old('login', @$row->login), ["placeholder" => "Usuario", "class" => "form-control"]) !!}

                                @error('login')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Clave <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Clave">

                                @error('password')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Avatar <span class="text-danger">*</span></label>
                                <input type="file" name="avatar">

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Rol <span class="text-danger">*</span></label>

                                {!! Form::select('roles[]', $roles,
                                    (isset($row->roles) ? ($row->roles) : null), [
                                        'class'=> 'form-control select2',
                                        'multiple'
                                    ])
                                !!}
                                @error('roles')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('administration/users') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

                                    @if($typeForm == 'update')
                                        <button type="submit" class="btn btn-primary" id="send">
                                                <i class="flaticon-refresh"></i>
                                                Actualizar
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-primary" id="send">
                                            <i class="fas fa-save"></i>
                                            Registrar
                                        </button>
                                    @endif
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
