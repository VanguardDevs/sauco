@extends('layouts.template')

@section('title', 'Declaraciones del contribuyente '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('create.settlements'))
<div class="col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-settings-1"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Realizar liquidación 
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['settlements.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-8">
                        {!!
                            Form::select('month', $months, null, [
                                'class' => 'col-md-12 select2'
                            ])
                        !!}
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-success" type="submit">
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
            <table id="tDeclarations" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="20%">N°</th>
                    <th width="20%">Mes</th>
                    <th width="20%">Monto</th>
                    <th width="20%">Estado</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
