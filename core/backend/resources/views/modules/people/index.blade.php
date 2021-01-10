@extends('layouts.template')

@section('title', 'Control de representantes')

@section('breadcrumbs')
    {{ Breadcrumbs::render('representations') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de representantes</h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tRepresentations" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">Cédula</th>
                <th width="25%">Nombre</th>
                <th width="25%">Apellido</th>
                <th width="20%">Dirección</th>
                <th width="10%">Teléfono</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
