@extends('layouts.template')

@section('subheader__title', 'Pagos anulados')

@section('title', 'Pagos anulados')

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <table id="tNullPayments" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">N°</th>
                <th width="10%">RIF</th>
                <th width="50%">Razón social</th>
                <th width="10%">Monto</th>
                <th width="10%">Estado</th>
                <th width="10%">Anulado</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
