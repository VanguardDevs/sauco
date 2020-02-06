@extends('layouts.template')

@section('title', 'Registro de Requisitos')

{{-- @section('breadcrumbs')
    {{ Breadcrumbs::render('roles.index') }}
@endsection --}}

@section('content')

    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header alert alert-danger">
                    <div class="row">
                        <h5 class="m-0">Registro de Requisitos <b>(</b> <a href="{{ Route('requisites'.'.create') }}" title="Registrar parroquia">
                                <span>Registrar</span>
                            </a><b>)</b></h5>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tRequisites" class="table table-bordered table-striped datatables" style="text-align: center">
                        <thead>
                        <tr>
                            <th width="30%">Trámite</th>
                            <th width="60%">Requisito</th>
                            <th width="10%">Acciones</th>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
