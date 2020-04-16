@extends('layouts.template')

@section('title', 'Declaraciones de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('create.settlements'))
<div class="col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-file-medical"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Realizar declaración mensual
                    <small>
                        Seleccione un mes para procesar una declaración
                    </small>
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['settlements.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-5">
                        <label class="col-lg-12">Seleccione el año<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('year', $years, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                                'id' => 'years' 
                            ])
                        !!}

                        @error('year')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-5">
                        <label class="col-lg-12">Seleccione el mes<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('month', [], null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                                'id' => 'months' 
                            ])
                        !!}

                        @error('month')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-success" style="margin-top:2em;"title="Enviar liquidación" type="submit">
                            <i class="fas fa-paper-plane"></i>
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
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-folder-open"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Histórico de declaraciones
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table id="tAffidavits" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="15%">Año</th>
                    <th width="15%">Mes</th>
                    <th width="25%">Declarado</th>
                    <th width="25%">Calculado</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
