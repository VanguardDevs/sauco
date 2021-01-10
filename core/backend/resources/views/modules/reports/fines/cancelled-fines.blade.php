@extends('cruds.form')

@section('subheader__title', 'Multas anuladas')

@section('title', 'Reporte de multas anuladas')

@section('content')
    <!-- /.card -->
  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
              <table id="tCancelledFines" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="40%">Razón de anulación</th>
                    <th width="20%">Fecha</th>
                    <th width="10%">Monto</th>
                    <th width="10%">Usuario</th>
                    <th width="10%">Acciones</th>
                  </tr>
                </thead>
              </table>
            </div>

      </div>
    </div>
  </div>
@endsection
