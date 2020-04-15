@extends('layouts.template')

@section('title', 'Control de permisos')

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
                        Control de permisos
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('permissions.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo permiso">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table id="tPermissions" class="table table-bordered table-striped datatables" style="text-align: center">
                    <thead>
                    <tr>
                        <th width="30%">Nombre</th>
                        <th width="10%">Slug</th>
                        <th width="50%">Descripción</th>
                        <th width="10%">Acciones</th>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
