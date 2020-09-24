@extends('cruds.form')

@section('subheader__title', 'Facturas anuladas')

@section('title', 'Reporte de facturas anuladas')

@section('content')
    <!-- /.card -->
  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
              <table id="tCancelledPayments" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="40%">Razón de anulación</th>
                    <th width="30%">Razón social</th>
                    <th width="10%">Usuario</th>
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
