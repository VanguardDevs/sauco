@extends('layouts.template')

@section('title', 'Caja')

@section('breadcrumbs')
    {{ Breadcrumbs::render('payments') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Caja </h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tCashbox" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">No. Factura</th>
                <th width="40%">Razón social</th>
                <th width="10%">Estado</th>
                <th width="10%">Monto Total</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
