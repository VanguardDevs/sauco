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
                            Editar usuario: {{ @$row->login }}

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
                    <div class="form-group col-md-2">
                        <label class="control-label"> Tipo de contribuyente <span class="text-danger">*</span></label>

                        <select name="taxpayer_type" class="form-control select2" id="taxpayer_type">
                            @foreach ($types as $taxpayer_type)
                                @if(old('taxpayer_type_id') == $taxpayer_type->id OR @$taxpayer->taxpayerType->id == $taxpayer_type->id) selected @endif
                                <option value="{{ $taxpayer_type->id }}" >
                                    {{ $taxpayer_type->description }}
                                </option>
                            @endforeach
                        </select>

                        @error('taxpayer_type')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                        <div class="form-group col-md-4">
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
                        <div class="form-group col-md-4" id="hide_form" style="display:none;">
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
                        <div class="form-group col-md-3">
                            <label class="control-label">RIF <span class="text-danger">*</span></label>

                            {!!
                            Form::text("rif", old('rif', @$row->rif), [
                                "class" => "form-control input-mask-rif",
                                "placeholder" => "RIF del contribuyente",
                                "onkeyup" => "upperCase(this);",
                                "id" => 'rif'
                            ])
                            !!}

                            @error('rif')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label"> Dirección <span class="text-danger">*</span></label>

                        {!!
                        Form::textarea("address", old('address', @$row->address), [
                            "Placeholder" => "Dirección del contribuyente",
                            "class" => "form-control",
                            "onkeyup" => "upperCase(this);",
                            "rows" => 1,
                            "cols" => 1
                        ])
                        !!}

                        @error('address')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Sector Económico <span class="text-danger">*</span></label>

                        <select name="economic_sector" class="form-control select2">
                            <option value="">===== SELECCIONE =====</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}" @if(old('economicSector') == $sector->id OR @$row->sector->id == $sector->id) selected @endif >
                                {{ $sector->description }}
                                </option>
                            @endforeach
                        </select>

                        @error('economic_sector')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Estado de permanencia <span class="text-danger">*</span></label>

                        {!!
                        Form::select('permanent_status', [
                            'RESIDENTE' => 'RESIDENTE',
                            'TRANSEÚNTE' => 'TRANSEÚNTE'
                            ], null, [
                            'class'=>'col-md-12 form-control select2',
                            'placeholder' => ' SELECCIONE ',
                        ])
                        !!}

                        @error('permanent_status')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-lg-6">
                        <label> Representante <span class="text-danger">*</span></label>

                        <select name="representation" class="form-control select2" id="economicSector">
                            @foreach ($representations as $representation)
                            @if(old('representation_id') == $representation->id OR @$taxpayer->representation->representation_id == $representation->id) selected @endif
                            <option value="{{ $representation->id }}" >
                                {{ $representation->first_name }}
                            </option>
                            @endforeach
                        </select>

                        @error('representation')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    <div class="form-group col-md-3">
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
                    <div class="form-group col-md-3">
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
                    </div>
                    <div class="kt-separator kt-separator--border-solid kt-separator--portlet-fit kt-separator--space-lg"></div>
                    <div class="row">
                    <div class="form-group col-md-12">
                        <div class="form-group col-lg-12">
                        <div class="kt-heading kt-heading--md">
                            Actividades económicas
                        </div>
                        </div>
                        <select name="economic_activities[]" class="form-control select2" multiple="multiple" id="economicActivities">
                        @foreach ($economicActivities as $activity)
                        @if(old('economic_activity_id') == $activity->id OR @$taxpayer->economicActivities->economic_activity_id == $activity->id) selected @endif
                            <option value="{{ $activity->id }}" >
                            {{ $activity->code."   |   ".$activity->name }}
                            </option>
                        @endforeach
                        </select>

                        @error('economic_activities')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="kt-separator kt-separator--border-solid kt-separator--portlet-fit kt-separator--space-lg"></div>
                    <div class="row">
                    <div class="form-group col-lg-12">
                        <div class="kt-heading kt-heading--md">
                        Registro comercial
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label"> Número <span class="text-danger">*</span></label>
                        {!! Form::text("num", old('num', @$row->num), [
                        "Placeholder" => "Número del registro comercial",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}
                        @error('num')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Tomo <span class="text-danger">*</span></label>
                        {!! Form::text("volume", old('volume', @$row->volume), [
                        "Placeholder" => "Tomo del registro comercial",
                        "class" => "form-control"
                        ]) !!}
                        @error('volume')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Expediente <span class="text-danger">*</span></label>
                        {!! Form::text(
                        "case_file",
                        old('case_file',
                        @$row->case_file
                        ), [
                        "Placeholder" => "Expediente",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}

                        @error('case_file')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Fecha de inicio de actividades <span class="text-danger">*</span></label>
                        {!! Form::text(
                        "start_date",
                        old('start_date', @$row->start_date),
                        [
                        "class" => "form-control date-input-mask",
                        "placeholder" => "DD/MM/AAAA"
                        ])
                        !!}

                        <span class="form-text text-muted">Formato de fecha:
                        <code>DD/MM/AAAA</code>
                        </span>
                        @error('start_date')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <div class="kt-separator kt-separator--border-solid kt-separator--portlet-fit kt-separator--space-lg"></div>
                    {{-- <div class="row">
                    <div class="form-group col-lg-12">
                        <div class="kt-heading kt-heading--md">
                        Datos generales del inmueble
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Parroquia <span class="text-danger">*</span></label>

                        {!!
                        Form::select('parish', $parishes, null, [
                            'class'=>'col-md-12 form-control select2',
                            'placeholder' => ' SELECCIONE ',
                            'id' => 'parishes'
                        ])
                        !!}

                        @error('parish')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Comunidad <span class="text-danger">*</span></label>

                        {!!
                        Form::select('community', [], null, [
                            'class'=>'col-md-12 form-control select2',
                            'placeholder' => ' SELECCIONE ',
                            'id' => 'communities'
                        ])
                        !!}

                        @error('community')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6"></div>
                    <div class="form-group col-md-6">
                        <label class="control-label"> Calle <span class="text-danger">*</span></label>
                        {!! Form::text("street", old('street', @$row->street),
                        [
                        "Placeholder" => "Calle/Avenida Ejemplo",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}
                        @error('street')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Tipo de edificio <span class="text-danger">*</span></label>

                        {!!
                        Form::select('building_type', [
                            'RESIDENCIAL' => 'RESIDENCIAL',
                            'COMERCIAL' => 'COMERCIAL'
                            ], null, [
                            'class'=>'col-md-12 form-control select2',
                            'placeholder' => ' SELECCIONE ',
                        ])
                        !!}

                        @error('building_type')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label col-md-12"> Estado de propiedad <span class="text-danger">*</span></label>

                        {!!
                        Form::select('owner_status', [
                            'PROPIETARIO' => 'PROPIETARIO',
                            'ALQUILADO' => 'ALQUILADO'
                            ], null, [
                            'class'=>'col-md-12 form-control select2',
                            'placeholder' => ' SELECCIONE ',
                            'id' => 'owner_status'
                        ])
                        !!}

                        @error('owner_status')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3" style="display:none;" id="contract">
                        <label class="control-label"> Número de contrato <span class="text-danger">*</span></label>
                        {!! Form::text("contract", old('contract', @$row->contract),
                        [
                        "Placeholder" => "No. de contrato",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}
                        @error('contract')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3" style="display:none;" id="document">
                        <label class="control-label"> Número de documento de propiedad <span class="text-danger">*</span></label>
                        {!! Form::text("document", old('document', @$row->document),
                        [
                        "Placeholder" => "No. catastral del inmueble",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);",
                        ]) !!}
                        @error('document')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Número catastral <span class="text-danger">*</span></label>
                        {!! Form::text("cadastre_num", old('cadastre_num', @$row->cadastre_num),
                        [
                        "Placeholder" => "No. catastral del inmueble",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}
                        @error('cadastre_num')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Piso <span class="text-danger">*</span></label>
                        {!! Form::text("floor", old('floor', @$row->floor),
                        [
                        "Placeholder" => "Piso X",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}
                        @error('floor')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label"> Número o nombre del edificio<span class="text-danger">*</span></label>
                        {!! Form::text("local", old('local', @$row->local), [
                        "Placeholder" => "Número del edificio",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}
                        @error('local')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div> --}}
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
