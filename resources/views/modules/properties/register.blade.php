@extends('cruds.form')

@section('title', 'Registro de Inmueble')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Inmueble

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/properties/create') }}
                            @endsection
                        @else
                            Editar usuario: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/properties/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => ["add-property", $taxpayer->id], 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["add-property".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
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
                                    Form::select('property_type', $propertyTypes, null, [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    ])
                                !!}

                                @error('property_type')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label col-md-12"> Estado de propiedad <span class="text-danger">*</span></label>

                                {!!
                                    Form::select('ownership_status', $ownershipStatus, null, [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    'id' => 'ownership_status'
                                    ])
                                !!}

                                @error('ownership_status')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3" style="display:none;" id="contract">
                                <label class="control-label"> No. de contrato <span class="text-danger">*</span></label>
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
                                <label class="control-label"> No. de documento de propiedad <span class="text-danger">*</span></label>
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
                                <label class="control-label"> No. catastral <span class="text-danger">*</span></label>
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
                                    "Placeholder" => "No. del edificio",
                                    "class" => "form-control",
                                    "onkeyup" => "upperCase(this);"
                                ]) !!}
                                @error('local')
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
