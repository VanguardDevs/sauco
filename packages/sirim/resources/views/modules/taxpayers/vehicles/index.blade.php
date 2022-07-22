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
                {!! Form::open(['route' => ['vehicles.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
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

                            <div class="col-lg-6">
                                <label>Serial del Motor<span class="text-danger">*</span></label>

                                {!! Form::text('engine_serial', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('engine_serial')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Peso<span class="text-danger">*</span></label>

                                {!! Form::number('weight', null, ['class' => 'form-control', 'id' => 'weight']) !!}

                                @error('weight')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Capacidad<span class="text-danger">*</span></label>

                                {!! Form::number('capacity', null, ['class' => 'form-control', 'id' => 'capacity']) !!}

                                @error('capacity')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Puestos<span class="text-danger">*</span></label>

                                {!! Form::number('stalls', null, ['class' => 'form-control', 'id' => 'stalls']) !!}

                                @error('stalls')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="col-lg-3">Clasificación<span class="text-danger">*</span></label>
                                {!!
                                    Form::select('vehicleClassification', $vehicleClassification, null, [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE'
                                    ])
                                !!}

                                @error('vehicleClassification')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="col-lg-3">Modelo<span class="text-danger">*</span></label>
                                {!!
                                    Form::select('vehicleModel', $vehicleModel, null, [
                                        'class' => 'col-md-12 select2',
                                        'placeholder' => 'SELECCIONE'
                                    ])
                                !!}

                                @error('vehicleModel')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="col-lg-3">Color<span class="text-danger">*</span></label>
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

                            <div class="col-lg-6">
                                <br><br>
                                <label class="col-lg-6"><span class="text-danger"></span></label>

                                <button class="btn btn-success" type="submit">
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
              <table id="tVehicleLicenses" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="15%">Número</th>
                        <th width="15%">RIF</th>
                        <th width="20%">Razón social</th>
                        <th width="15%">Ordenanza</th>
                        <th width="10%">Estado</th>
                        <th width="10%">Emisión</th>
                        <th width="10%">Vencimiento</th>
                        <th width="5%">Acciones</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/js/licenses.js') }}"></script>
@endpush

