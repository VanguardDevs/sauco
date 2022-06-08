@extends('cruds.form')

@section('title', 'Nuevo Parámetro')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                @if ($typeForm == 'create')
                    {!! Form::open(['url' => route('liqueur-parameters.store', [$liqueurParameter->id]), 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ['liqueur-parameters.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group col-lg-12">
                            <div class="kt-heading kt-heading--md">
                            Datos del parámetro
                            </div>
                         </div>
                       <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Descripción <span class="text-danger">*</span></label>

                                {!! Form::text('description', old('description', @$row->description), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('description')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Registro </label>

                                {!! Form::text('new_registry_amount', old('new_registry_amount', @$row->new_registry_amount), ['class' => 'form-control', "onkeyup" => "upperCase(this);"]) !!}

                                @error('new_registry_amount')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Renovación <span class="text-danger">*</span></label>

                                {!! Form::text('renew_registry_amount', old('renew_registry_amount', @$row->renew_registry_amount), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('renew_registry_amount')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Autorización </label>

                                {!! Form::text('authorization_registry_amount', old('authorization_registry_amount', @$row->authorization_registry_amount), ['class' => 'form-control', "onkeyup" => "upperCase(this);"]) !!}

                                @error('authorization_registry_amount')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Clasificación <span class="text-danger">*</span></label>

                                {!!
                                    Form::select('liqueur_classification', $liqueurClassification,
                                    (isset($classification) ? $type: null), [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    ])
                                !!}

                                @error('liqueur_classification')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Zona <span class="text-danger">*</span></label>

                                {!!
                                    Form::select('liqueur_zone', $liqueurZone,
                                    (isset($zone) ? $type: null), [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    ])
                                !!}

                                @error('liqueur_zone')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Método de Cobro <span class="text-danger">*</span></label>

                                {!!
                                    Form::select('charging_method', $chargingMethod,
                                    (isset($method) ? $type: null), [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    ])
                                !!}

                                @error('charging_method')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ URL::previous() }}" class="btn btn-danger"><i class="flaticon-cancel"></i> Cancelar</a>

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
