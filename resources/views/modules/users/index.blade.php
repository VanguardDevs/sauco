@extends('layouts.template')

@section('title', 'Control de Usuarios')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administration/users') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Usuarios <b>(</b> <a href="{{ Route($options['route'].'.create') }}" title="Registrar usuario">
              <span>Registrar</span>
            </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tUsers" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="15%">Cédula</th>
                <th width="20%">Nombre</th>
                <th width="20%">Apellido</th>
                <th width="20%">Teléfono</th>
                <th width="20%">Usuario</th>
                <th width="5%"></th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
