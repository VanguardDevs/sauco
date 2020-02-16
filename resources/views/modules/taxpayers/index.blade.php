@extends('layouts.template')

@section('title', 'Contribuyentes')

@section('breadcrumbs')
    {{ Breadcrumbs::render('taxpayers') }}
@endsection

@section('content')
  <!-- end:: Subheader -->
  <!-- begin:: Table -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header alert alert-danger">
                    <div class="row">
                    <h5 class="m-0">Control de Contribuyentes <b>(</b> <a href="{{ Route("taxpayers".'.create') }}" title="Registrar comunidad">
                        <span>Registrar</span>
                        </a><b>)</b></h5>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tTaxpayers" class="table table-bordered table-striped datatables" style="text-align: center">
                        <thead>
                            <tr>
                                <th width="10%">RIF</th>
                                <th width="40%">Razón Social</th>
                                <th width="20%">Comunidad</th>
                                <th width="20%">Dirección fiscal</th>
                                <th width="10%">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
  <!-- end:: Table -->

@endsection
