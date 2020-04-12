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
                    Realizar solicitud
                    <small>
                        Seleccione un concepto de recaudación
                    </small>
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['settlements.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-5">
                        <label class="col-lg-12">Seleccione la ordenanza<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('ordinance', $ordinances, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                                'id' => 'years' 
                            ])
                        !!}

                        @error('ordinance')
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
                    Histórico de solicitudes
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ url("/") }}" class="btn btn-label-brand btn-bold btn-sm" title="Imprimir histórico de liquidaciones">
                    <i class="fas fa-print"></i>
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table id="tApplications" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="60%">Concepto</th>
                    <th width="20%">Realizada</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
