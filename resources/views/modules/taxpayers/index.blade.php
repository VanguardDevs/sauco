@extends('layouts.template')

@section('subheader__title', 'Contribuyentes')

@section('title', 'Control de contribuyentes')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Control de contribuyentes
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                       @if (Auth()->user()->can('create.taxpayers'))
                        <a href="{{ Route('taxpayers.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo contribuyente">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endif
                        @if (Auth()->user()->can('print.reports'))
                        <a href="{{ Route('print.taxpayers') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Imprimir listado" target='_blank'>
                            <i class="fas fa-print"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
              <table id="tTaxpayers" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="10%">RIF</th>
                        <th width="50%">Razón Social</th>
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
