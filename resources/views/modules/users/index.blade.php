@extends('layouts.template')

@section('title', 'Control de Usuarios')

@section('content')

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Control de usuarios
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('users.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo usuario">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
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
