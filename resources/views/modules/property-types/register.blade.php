@extends('cruds.form')

@section('title', 'Registro de Tipos de Inmueble')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Tipos de Inmueble

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/property-types/create') }}
                            @endsection
                        @else
                            Editar tipo de inmueble:

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/property-types/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => "property-types".'.store', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["property-types".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Clasificación<span class="text-danger">*</span></label>

                                {!! Form::text('classification', old('classification', @$row->classification), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('classification')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Denominación<span class="text-danger">*</span></label>

                                {!! Form::text('denomination', old('denomination', @$row->denomination), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('denomination')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Monto<span class="text-danger">*</span></label>

                                {!! Form::text('amount', old('amount', @$row->amount), ['class' => 'form-control decimal-input-mask', "required"]) !!}

                                @error('amount')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Método de cobro<span class="text-danger">*</span></label>

                                {!! Form::select('charging_method', $chargingMethods,
                                    (isset($row->chargingMethod) ? ($row->chargingMethod->id) : null),
                                    [
                                        'class' => 'col-md-12 form-control select2',
                                        'placeholder' => ' SELECCIONE ',
                                        "required"
                                    ])
                                !!}

                                @error('charging_method')
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
