@extends('layouts.template')

@section('subheader__title', 'Actividades económicas')

@section('title', 'Control de actividades económicas')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fas fa-percent"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Control de actividades económicas
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
               @if (Auth()->user()->can('create.economic-activities'))
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('economic-activities.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nueva actividad">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                @endif
                @if (Auth()->user()->can('access.reports'))
                    <a href="{{ Route('print.activities') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Imprimir listado" target='_blank'>
                        <i class="fas fa-print"></i>
                    </a>
                @endif
                </div>
            </div>
            <div class="kt-portlet__body">
              <table id="tEconomicActivities" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="10%">Código</th>
                    <th width="50%">Nombre</th>
                    <th width="10%">Alícuota</th>
                    <th width="15%">Mín. tributable</th>
                    <th width="15%">Acciones</th>
                  </tr>
                </thead>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
