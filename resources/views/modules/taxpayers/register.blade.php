@extends('cruds.form')

@section('title', 'Registro de contribuyente')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Contribuyente

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('taxpayers/create') }}
                            @endsection
                        @else
                            Editar contribuyente: {{ @$row->rif }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('taxpayers/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
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

                            {!! Form::select('taxpayer_type', $types,
                                (isset($row->taxpayerType) ? ($row->taxpayerType->id) : null), [
                                'class' => 'form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'id' => 'taxpayer_type',
                                'required'
                            ]) !!}

                            @error('taxpayer_type')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">RIF <span class="text-danger">*</span></label>

                            {!!
                            Form::text("rif", old('rif', @$row->rif), [
                                "class" => "form-control input-mask-rif",
                                "placeholder" => "RIF del contribuyente",
                                "id" => 'rif'
                            ])
                            !!}

                            @error('rif')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Nombre (Razón Social)<span class="text-danger">*</span></label>
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
                        <div class="form-group col-md-6" id="commercial_denomination" style="display:none;">
                            <label class="control-label">Denominación comercial (Firma personal)</label>
                            {!!
                            Form::text("trade_denomination", old('trade_denomination', @$row->denomination), [
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);"
                            ])
                            !!}

                            @error('trade_denomination')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label"> Sector Económico <span class="text-danger">*</span></label>

                            {!! Form::select('economic_sector', $sectors,
                                (isset($row->economicSector) ? ($row->economicSector->id) : null), [
                                'class' => 'form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'required'
                            ]) !!}

                            @error('economic_sector')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
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
                        <div class="form-group col-md-4">
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

                        <div class="form-group col-md-4">
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
                        <div class="form-group col-md-4">
                            <label class="control-label"> Municipio <span class="text-danger">*</span></label>

                            {!!
                                Form::select('municipality', [], null, [
                                'class'=>'col-md-12 form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'id' => 'municipalities', 'required'
                                ])
                            !!}

                            @error('municipality')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Origen del contribuyente <span class="text-danger">*</span></label>

                            {!!
                            Form::textarea("locality", old('locality', @$row->locality), [
                                "Placeholder" => "Ciudad o población",
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);", 'required',
                                "rows" => 1,
                                "cols" => 1
                            ])
                            !!}

                            @error('locality')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Parroquia <span class="text-danger">*</span></label>

                            {!!
                                Form::select('parish', $parishes, null, [
                                'class'=>'col-md-12 form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'id' => 'parishes',
                                'required'
                                ])
                            !!}

                            @error('parish')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Comunidad <span class="text-danger">*</span></label>

                            {!!
                                Form::select('community', [], null, [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    'id' => 'communities',
                                    'required'
                                ])
                            !!}

                            @error('community')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Dirección o domicilio <span class="text-danger">*</span></label>

                            {!!
                            Form::textarea("fiscal_address", old('fiscal_address', @$row->fiscal_address), [
                                "Placeholder" => "Domicilio",
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);",
                                "rows" => 1,
                                "cols" => 1,
                                'required'
                            ])
                            !!}

                            @error('fiscal_address')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label"> Capital suscrito </label>

                            {!!
                            Form::text("capital", old('capital', @$row->capital), [
                                "class" => "form-control decimal-input-mask"
                            ])
                            !!}

                            @error('capital')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label"> Conformidad de uso </label>

                            {!!
                            Form::text("compliance_use", old('compliance_use', @$row->compliance_use), [
                                "Placeholder" => "",
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);"
                            ])
                            !!}

                            @error('compliance_use')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

                    @if($typeForm == 'update')
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
