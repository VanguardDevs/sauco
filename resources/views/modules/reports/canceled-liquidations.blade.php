@extends('layouts.template')

@section('subheader__title', 'Liquidaciones anuladas')

@section('title', 'Liquidaciones anuladas')

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <table id="tCanceledLiquidations" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">N°</th>
                <th width="30%">Razón social</th>
                <th width="30%">Razón de anulación</th>
                <th width="10%">Monto</th>
                <th width="10%">Fecha</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
