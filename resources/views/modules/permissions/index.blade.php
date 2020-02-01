@extends('layouts.template')

@section('title', 'Registro de Permisos')

{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('roles.index') }}
@endsection --}}

@section('content')

    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header alert alert-danger">
                    <div class="row">
                        <h5 class="m-0">Registro de Permisos <b>(</b> <a href="{{ Route('permissions'.'.create') }}" title="Registrar parroquia">
                                <span>Registrar</span>
                            </a><b>)</b></h5>
                    </div>
                </div>

                <div class="card-body">
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
