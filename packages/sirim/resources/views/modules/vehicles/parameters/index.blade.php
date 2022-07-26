@extends('layouts.template')

@section('title', 'Colores de Vehículos')

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
                        Colores de Vehiculos
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('vehicle-parameters.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo Color">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table id="tVehicleParameters" class="table table-bordered table-striped datatables" style="text-align: center">
                    <thead>
                    <tr>
                        <th width="40%">Nombre</th>
                        <th width="20%">Acciones</th>

                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
