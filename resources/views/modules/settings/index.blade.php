@extends('layouts.template')

@section('title', 'Configuraciones')

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings/general') }}
@endsection

@section('content')
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-settings-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        @if(@Auth::user()->hasRole('admin'))
                            Configuraciones
                        @endif
                    </h3>
                </div>
            </div>

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <button class="btn btn-info" onClick="onClickFiscalYear()">
                        <i class="flaticon-rocket"></i> Año fiscal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
