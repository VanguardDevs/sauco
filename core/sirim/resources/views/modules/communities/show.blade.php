@extends('layouts.template')

@section('subheader__title', $row->name)

@section('title', 'Reporte de la comunidad '.$row->name)

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Existen {{ $row->taxpayers->count() }} contribuyentes registrados en esta comunidad 
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        @if (Auth()->user()->can('print.reports'))
                        <a href="{{ url('geographic-area/communities/'.$row->id.'?pdf=true') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Imprimir listado">
                            <i class="fas fa-print"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
              <table id="tTaxpayersByCommunity" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="10%">RIF</th>
                    <th width="50%">Razón social</th>
                    <th width="30%">Dirección fiscal</th>
                    <th width="10%">Acciones</th>
                  </tr>
                </thead>
              </table>            
            </div>
        </div>
    </div>
</div>

@endsection
