@extends('cruds.form')

@section('title', 'Nuevo representante')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Datos generales de la persona
                        @else
                            Editar usuario: {{ @$row->login }}
                        @endif
                        </h3>
                    </div>
                </div>
                @if ($typeForm == 'create')
                    {!! Form::open(['url' => route('person.store', [$taxpayer->id]), 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["representation".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Primer nombre <span class="text-danger">*</span></label>

                                {!! Form::text('first_name', old('first_name', @$row->first_name), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('first_name')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Segundo nombre </label>

                                {!! Form::text('second_name', old('second_name', @$row->second_name), ['class' => 'form-control', "onkeyup" => "upperCase(this);"]) !!}

                                @error('second_name')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Primer Apellido <span class="text-danger">*</span></label>

                                {!! Form::text('surname', old('surname', @$row->surname), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('surname')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Segundo apellido </label>

                                {!! Form::text('second_surname', old('second_surname', @$row->second_surname), ['class' => 'form-control', "onkeyup" => "upperCase(this);"]) !!}

                                @error('second_surname')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Nacionalidad <span class="text-danger">*</span></label>

                                {!!
                                    Form::select('citizenship', $citizenships,
                                    (isset($citizen) ? $citizen : null), [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    'id' => 'citizenships'
                                    ])
                                !!}

                                @error('citizenship')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Cédula de identidad <span class="text-danger">*</span></label>

                                {!! Form::text('document', old('document', @$document), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('document')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Tipo de representante<span class="text-danger">*</span></label>

                                {!!
                                    Form::select('representation_type', $representationTypes,
                                    (isset($type) ? $type: null), [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    ])
                                !!}

                                @error('representation_type')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Dirección </label>

                                {!! Form::textarea('address', old('address', @$row->address), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "rows" => 2, "cols" => 2]) !!}

                                @error('address')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Teléfono </label>

                                {!! Form::text('phone', old('phone', @$row->phone), ['class' => 'form-control phone-input-mask', "onkeyup" => "upperCase(this);"]) !!}

                                @error('phone')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Correo electrónico </label>

                                {!! Form::text('email', old('email', @$row->email), ['class' => 'form-control email-input-mask']) !!}

                                @error('email')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('taxpayers/'.$taxpayer->id) }}" class="btn btn-danger"><i class="flaticon-cancel"></i> Regresar</a>

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
