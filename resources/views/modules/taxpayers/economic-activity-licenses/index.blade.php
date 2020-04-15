@extends('layouts.template')

@section('title', 'Patentes de actividad económica')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
             <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fas fa-file-medical"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Listado de patentes de actividad económica emitidas
                    </h3>
                </div>
                 <div class="kt-portlet__head-toolbar">
                    @if(@Auth::user()->can('reports.print'))
                    <a href="{{ route('economic-activity-licenses.print-list') }}" class="btn btn-circle btn-icon" title="Imprimir reporte">
                        <i class="fas fa-print kt-font-brand"></i>
                    </a>
                    @endif
                </div>
           </div>
           <div class="kt-portlet__body">
              <table id="tEconomicActivityLicenses" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="15%">Número</th>
                        <th width="15%">RIF</th>
                        <th width="50%">Razón social</th>
                        <th width="10%">Fecha</th>
                        <th width="10%">Acciones</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection
