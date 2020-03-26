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
                    Realizar liquidación mensual
                    <small>
                        Seleccione un mes para procesar una declaración
                    </small>
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['settlements.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-10">
                        {!!
                            Form::select('month', $months, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                            ])
                        !!}

                        @error('month')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-success" title="Enviar liquidación" type="submit">
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
                    Histórico de liquidaciones
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ url("/") }}" class="btn btn-label-brand btn-bold btn-sm" title="Imprimir histórico de liquidaciones">
                    <i class="fas fa-print"></i>
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table id="tAffidavits" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="10%">N°</th>
                    <th width="25%">Mes</th>
                    <th width="25%">Monto Total</th>
                    <th width="20%">Estado</th>
                    <th width="10%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
