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
                        <h5 class="m-0">Registro de Permisos <b>(</b> <a href="{{ Route($options['route'].'.create') }}" title="Registrar parroquia">
                                <span>Registrar</span>
                            </a><b>)</b></h5>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped datatables" style="text-align: center">
                        <thead>
                        <tr>
                            <th width="35%">Nombre</th>
                            <th width="10%">Slug</th>
                            <th width="50%">Descripción</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>
                                    {{ $permission->name }}
                                </td>
                                <td>
                                    {{ $permission->slug }}
                                </td>
                                <td>
                                    {{ $permission->description }}
                                </td>
                                <td>
                                    <a href="/administration/permissions/{{ $permission->id }}/edit" class="btn btn-sm btn-warning" title="Editar registro"><i class='flaticon-edit'></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <p>No hay registros asociados!</p>
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection