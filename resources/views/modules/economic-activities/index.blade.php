@extends('layouts.template')

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
               @if (Auth()->user()->hasRole('admin'))
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('economic-activities.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nueva actividad">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @endif
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
