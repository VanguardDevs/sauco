@extends('layouts.template')

@section('title', 'Timbres Fiscales de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div class="col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-stamp"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Registrar Timbre de Capacidad
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['capacity-stamps.store', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Seleccione la licencia<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('license', $existingLicenses, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE'
                            ])
                        !!}

                        @error('license')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Capacidad <span class="text-danger">*</span></label>

                        {!! Form::number('capacity', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                        @error('capacity')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-lg-12"></div>
                    <br>



                    <div class="col-lg-4">
                        <button class="btn btn-success" style="margin-top:2em;"title="Enviar" type="submit">
                            <i class="fas fa-paper-plane"></i>
                            Enviar
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif

<div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body">
            <table id="tCapacityStamps" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="15%">Licencia</th>
                    <th width="20%">Capacidad</th>
                    <th width="20%">Fecha</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
