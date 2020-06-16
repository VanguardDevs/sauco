@extends('layouts.template')

@section('title', 'Control de cuentas contables')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Control de Cuentas Contables
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('concepts.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo concepto de recaudación">
                            <i class="fas fa-plus"></i>
                        </a>
                     </div>
                </div>
            </div>
            <div class="kt-portlet__body">
          <table id="tConcepts" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="50%">Nombre</th>
                <th width="15%">Ordenanza</th>
                <th width="15%">Método</th>
                <th width="10%">Monto</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
