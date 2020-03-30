@extends('layouts.template')

@section('subheader__title', 'Pagos pendientes')

@section('title', 'Control de pagos pendientes')

@section('content')

<div class="row" style="margin-top: 20px;">
<div class="col-lg-12">
  <div class="kt-portlet">
    <div class="kt-portlet__body">
      <table id="tPayments" class="table table-bordered table-striped datatables" style="text-align: center">
        <thead>
          <tr>
            <th width="10%">N°</th>
            <th width="10%">RIF</th>
            <th width="50%">Razón social</th>
            <th width="10%">Monto</th>
            <th width="10%">Acciones</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
</div>

@endsection
