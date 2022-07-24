@extends('cruds.form')

@section('title', 'Nuevo Parámetro de Vehículo')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                @if ($typeForm == 'create')
                    {!! Form::open(['url' => route('vehicle-parameters.store', [$vehicleParameter->id]), 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ['vehicle-parameters.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group col-lg-12">
                            <div class="kt-heading kt-heading--md">
                            Datos del Parámetro
                            </div>
                         </div>
                       <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Nombre <span class="text-danger">*</span></label>

                                {!! Form::text('name', old('name', @$row->name), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('name')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Años </label>

                                {!!
                                    Form::select('years', $boolean, old('years', @$row->years), [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE'
                                    ])
                                !!}

                                @error('years')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Peso </label>

                                {!!
                                    Form::select('weight', $boolean, old('weight', @$row->weight), [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE'
                                    ])
                                !!}

                                @error('weight')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-lg-6">
                                <label>Capacidad</label>

                                {!!
                                    Form::select('capacity', $boolean, old('capacity', @$row->capacity), [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE'
                                    ])
                                !!}

                                @error('capacity')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Puestos</label>

                                {!!
                                    Form::select('stalls', $boolean, old('stalls', @$row->stalls), [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE'
                                    ])
                                !!}

                                @error('stalls')
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
