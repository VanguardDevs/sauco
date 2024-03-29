@extends('layouts.template')

@section('subheader__title', 'Contribuyentes')

@section('title', 'Control de contribuyentes')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <div class="kt-widget4">
                    <a href="{{ Route('representations.index') }}" class="kt-widget4__item">
                        <div class="kt-widget4__icon">
                            <i class="flaticon-users-1"></i>
                        </div>
                        <div class="kt-widget4__title kt-widget4__title--dark">
                            <div class="kt-notification__item-title">
                                Representantes
                            </div>
                            <small>
                            {{ $numPersons }} personas registradas
                            </small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
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
