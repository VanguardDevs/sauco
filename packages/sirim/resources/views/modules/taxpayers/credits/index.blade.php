@extends('layouts.template')

@section('title', 'Creditos de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div id='credits'></div>
<div id="data" data-taxpayer-id="{{ $taxpayer->id }}" data-user-id="{{ auth()->user()->id }}"></id>

<div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-folder-open"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Histórico de creditos
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table id="tCredits" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="30%">Número</th>
                    <th width="30%">Monto</th>
                    <th width="20%">Número de Factura</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endif
@endsection
