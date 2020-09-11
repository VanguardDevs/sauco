@extends('layouts.template')

@section('title', 'Declaraciones de '.$taxpayer->rif)

@section('content')

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
        </div>
        <div class="kt-portlet__body">
            <table id="tTaxpayerLiquidations" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="10%">Número</th>
                    <th width="40%">Concepto</th>
                    <th width="10%">Estado</th>
                    <th width="20%">Monto</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
