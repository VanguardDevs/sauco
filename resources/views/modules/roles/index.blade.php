@extends('layouts.template')

@section('title', 'Roles')

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Roles de Usuarios <b>(</b> <a href="{{ Route("roles".'.create') }}" title="Registrar parroquia">
              <span>Registrar</span>
            </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
            <table id="tRoles" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                <tr>
                    <th width="20%">Nombre</th>
                    <th width="10%">Slug</th>
                    <th width="40%">Descripción</th>
                    <th width="20%">Permiso especial</th>
                    <th width="10%">Acciones</th>
                </tr>
            </table>
        </div>

      </div>
    </div>
  </div>

@endsection
