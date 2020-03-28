@extends('layouts.template')

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
               @if (Auth()->user()->can('create.taxpayers'))
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('taxpayers.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nueva actividad">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <div class="kt-portlet__body">
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

@endsection
