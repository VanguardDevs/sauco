@extends('layouts.template')

@section('title', 'Control de Solicitudes')

@section('breadcrumbs')
    {{ Breadcrumbs::render('applications') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Solicitudes </h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tApplications" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">Nro.</th>
                <th width="10%">RIF</th>
                <th width="50%">Tipo de solicitud</th>
                <th width="10%">Estado</th>
                <th width="5%">Publicado</th>
                <th width="5%">Actualizado</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
