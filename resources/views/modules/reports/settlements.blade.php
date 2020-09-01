@extends('cruds.form')

@section('subheader__title', 'Liquidaciones procesadas')

@section('title', 'Reporte de liquidaciones procesadas')

@section('content')
    <!-- /.card -->
  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="kt-portlet">
        <div class="kt-portlet__body">
          <table id="tProcessedSettlements" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">N°</th>
                <th width="10%">RIF</th>
                <th width="40%">Concepto</th>
                <th width="10%">Usuario</th>
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
