@extends('layouts.template')

@section('title', 'Control de Liquidaciones')

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">
                Liquidaciones
            </h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tSettlements" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">Núm.</th>
                <th width="60%">Por concepto de</th>
                <th width="10%">Estado</th>
                <th width="10%">Creada</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
