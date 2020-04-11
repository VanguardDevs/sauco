@extends('cruds.form')

@section('subheader__title', 'Nuevo contribuyente')

@if ($typeForm == 'create')
    @section('title', 'Nuevo contribuyente')
@else
    @section('title', 'Actualización de contribuyente')
@endif

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <!-- form start -->
                @if ($typeForm == 'create')
                {!! Form::open(['route' => 'taxpayers'.'.store', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                @else
                {!! Form::model($row, ['route' => ['taxpayers'.'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <div class="kt-heading kt-heading--md">
                            Datos generales del contribuyente:
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label"> Tipo <span class="text-danger">*</span></label>

                            {!! Form::select('taxpayer_type_id', $types,
                                (isset($row->taxpayerType) ? ($row->taxpayerType->id) : null), [
                                'class' => 'form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'id' => 'taxpayer_type',
                                'required'
                            ]) !!}

                            @error('taxpayer_type_id')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">RIF <span class="text-danger">*</span></label>

                            {!!
                            Form::text("rif", (isset($row->rif) ? $row->getOriginal('rif') : null), [
                                "class" => "form-control input-mask-rif",
                                "placeholder" => "RIF del contribuyente",
                                "id" => 'rif'
                            ])
                            !!}

                            @error('rif')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Razón social o nombre <span class="text-danger">*</span></label>
                            {!!
                            Form::text("name", old('name', @$row->name), [
                                "Placeholder" => "Nombre o Razón social del contribuyente",
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);"
                            ])
                            !!}

                            @error('name')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
 
                        <div class="form-group col-md-12">
                            <label class="control-label">Firma personal o denominación comercial</label>

                            {!!
                            Form::text("personal_firm", old('personal_firm', @$row->commercialDenomination->name), [
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);"
                            ])
                            !!}

                            @error('personal_firm')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Teléfono</label>
                            <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                            {!!
                                Form::text( "phone", old('phone', @$row->phone), [
                                "class" => "form-control phone-input-mask",
                                "placeholder" => "Teléfono del contribuyente"
                                ])
                            !!}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Correo</label>
                            <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                            {!! Form::text(
                            "email",
                            old('email', @$row->email),
                            [
                                "class" => "form-control email-input-mask",
                                "placeholder" => "Correo del contribuyente"
                            ])
                            !!}
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="kt-heading kt-heading--md">
                            Dirección fiscal
                            </div>
                        </div>
                        {{--
                        <div class="form-group col-md-6">
                            <label class="control-label"> Estado <span class="text-danger">*</span></label>

                            {!!
                                Form::select('state', $states, null, [
                                'class'=>'col-md-12 form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'id' => 'states',
                                'required'
                                ])
                            !!}

                            @error('state')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label"> Municipio <span class="text-danger">*</span></label>

                            {!!
                                Form::select('municipality_id', [], null, [
                                'class'=>'col-md-12 form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'id' => 'municipalities', 'required'
                                ])
                            !!}

                            @error('municipality_id')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        --}}
                        <div class="form-group col-md-6">
                            <label class="control-label"> Comunidad <span class="text-danger">*</span></label>

                            {!!
                                Form::select('community_id', $communities,
                                    null, [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    'id' => 'communities',
                                    'required'
                                ])
                            !!}

                            @error('community_id')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label"> Dirección <span class="text-danger">*</span></label>

                            {!!
                            Form::text("fiscal_address", (isset($row->fiscal_address) ? $row->getOriginal('fiscal_address') : null), [
                                "Placeholder" => "Calle o avenida, # Nro. del edificio",
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);",
                                'required'
                            ])
                            !!}

                            @error('fiscal_address')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

                    @if($typeForm == 'edit')
                    <button type="submit" class="btn btn-primary">
                        <i class="flaticon2-reload"></i>
                        Actualizar
                    </button>
                    @else
                    <button  type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Registrar
                    </button>
                    @endif
                </div>
                {!! Form::close() !!}
                <!-- end:: Content -->
                </div>
        </div>
    </div>
@endsection
