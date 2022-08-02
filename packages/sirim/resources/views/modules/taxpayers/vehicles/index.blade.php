@extends('layouts.template')

@section('title', 'Patentes de Vehículo del contribuyente '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('create.licenses'))
    <div class="col-md-12">

        <div class="kt-portlet kt-portlet--height-fluid">


            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-paper"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Emitir Patente de Vehículo
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {!! Form::open(['url' => route('vehicles.create', [$taxpayer->id]), 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                    <div class="form-group row">

                        <div class="row" id= "new_license">

                            <div class="col-lg-6">
                                <label>Placa <span class="text-danger">*</span></label>

                                {!! Form::text('plate', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('plate')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Serial de la Carroceria<span class="text-danger">*</span></label>

                                {!! Form::text('body_serial', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('body_serial')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label class="col-lg-12"></label>

                            <div class="col-lg-6">
                                <label>Serial del Motor<span class="text-danger">*</span></label>

                                {!! Form::text('engine_serial', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('engine_serial')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Peso<span class="text-danger">*</span></label>

                                {!! Form::number('weight', 0, ['class' => 'form-control', 'pattern' => '[0-9]+([\.,][0-9]+)?', 'step' => '0.01', 'placeholder' => '0,00']) !!}

                                @error('weight')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label class="col-lg-12"></label>

                            <div class="col-lg-6">
                                <label>Capacidad<span class="text-danger">*</span></label>

                                {!! Form::number('capacity', 0, ['class' => 'form-control', 'pattern' => '[0-9]+([\.,][0-9]+)?', 'step' => '0.01', 'placeholder' => '0,00']) !!}

                                @error('capacity')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Puestos<span class="text-danger">*</span></label>

                                {!! Form::number('stalls', 0, ['class' => 'form-control', 'id' => 'stalls', 'placeholder' => '0']) !!}

                                @error('stalls')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label class="col-lg-12"></label>

                            <div class="col-lg-6">
                                <label>Parámetro<span class="text-danger">*</span></label>
                                {!!
                                    Form::select('vehicleParameter', $vehicleParameter, null, [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE',
                                        'id' => 'vparameters'
                                    ])
                                !!}

                                @error('vehicleParameter')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Clasificación<span class="text-danger">*</span></label>
                                {!!
                                    Form::select('vehicleClassification', [], null, [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE',
                                        'id' => 'vehicleClassifications',
                                        'required'
                                    ])
                                !!}

                                @error('vehicleClassification')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label class="col-lg-12"></label>

                            <div class="col-lg-6">
                                <label>Modelo<span class="text-danger">*</span></label>
                                {!!
                                    Form::select('vehicleModel', $vehicleModel, null, [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE',

                                    ])
                                !!}

                                @error('vehicleModel')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Color<span class="text-danger">*</span></label>
                                {!!
                                    Form::select('color', $color, null, [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE'
                                    ])
                                !!}

                                @error('color')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <br><br>
                                <label class="col-lg-6"><span class="text-danger"></span></label>

                                <button style="align:center" class="btn btn-success" type="submit">
                                    Enviar
                                </button>
                            </div>


                        </div>


                    </div>
                {!! Form::close() !!}
            </div>
    </div>

    </div>
@endif


<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
             <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fas fa-file-medical"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Listado de patentes de vehiculos emitidas
                    </h3>
                </div>
           </div>
           <div class="kt-portlet__body">
              <table id="tVehicle" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="15%">Placa</th>
                        <th width="15%">Serial de Carrocería</th>
                        <th width="20%">Serial del Motor</th>
                        <th width="5%">Peso</th>
                        <th width="4%">Capacidad</th>
                        <th width="3%">Puestos</th>
                        <th width="10%">Contribuyente</th>
                        <th width="5%">Modelo</th>
                        <th width="10%">Color</th>
                        <th width="10%">Clasificación</th>
                        <th width="10%">Estado</th>
                        <th width="5%">Acciones</th>

                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection

