@extends('layouts.template')

@section('title', 'Control de Métodos de Cobro')

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings/charging-methods') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Métodos de Cobro <b>(</b> <a href="{{ Route("charging-methods".'.create') }}" title="Registrar comunidad">
                <span>Registrar</span>
              </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tChargingMethods" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">ID</th>
                <th width="70%">Nombre</th>
                <th width="20%">Fecha de Ingreso</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
