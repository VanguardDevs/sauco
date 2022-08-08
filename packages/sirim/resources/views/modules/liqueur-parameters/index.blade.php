@extends('layouts.template')

@section('title', 'Parametros de Expendios')

@section('content')

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fas fa-file-medical"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Parametros de Expendios
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('liqueur-parameters.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo Parámetro">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table id="tParameters" class="table table-bordered table-striped datatables" style="text-align: center">
                    <thead>
                    <tr>
                        <th width="30%">Descripción</th>
                        <th width="5%">Registro</th>
                        <th width="5%">Renovación</th>
                        <th width="5%">Autorización</th>
                        <th width="15%">Clasificación</th>
                        <th width="15%">Zonas</th>
                        <th width="10%">Forma de Cobro</th>
                        <th width="5%">Acciones</th>

                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
