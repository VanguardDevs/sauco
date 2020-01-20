@extends('layouts.template')

@section('title', 'Roles')

@section('breadcrumbs')
    {{ Breadcrumbs::render('administration/roles') }}
@endsection

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
          <table class="table table-bordered table-striped datatables" style="text-align: center">
            <tr>
              <th width="25%">Nombre</th>
              <th width="20%">Slug</th>
              <th width="30%">Descripción</th>
              <th width="15%">Permiso Especial</th>
              <th width="10%"></th>
            </tr>
            @forelse ($roles as $key => $role)
              <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->slug }}</td>
                <td>{{ $role->description }}</td>
                <td>{{ $role->special }}</td>
                <td>
                  <a title="Editar rol" class="btn btn-warning" href="{{ route('roles.edit',$role->id) }}"><i class='flaticon-edit'></i></a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3">No hay registros asociados</td>
              </tr>
            @endforelse
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
