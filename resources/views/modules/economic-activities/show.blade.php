@extends('layouts.template')

@section('subheader__title', 'Actividad '.$row->code)

@section('title', 'Reporte de la actividad '.$row->code)

@section('content')
<div class="kt-portlet kt-portlet--height-fluid">
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <a class="kt-widget__username" href="{{ Route('economic-activities.show', $row->id) }}">
                            {{ $row->name }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-widget__bottom">
                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-technology-1"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">Código</span>
                        <span class="kt-widget__value">{{ $row->code }}</span>
                    </div>
                </div>

                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon2-percentage"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">Alícuota</span>
                        <span class="kt-widget__value">{{ $row->aliquote }}<span> %</span></span>
                    </div>
                </div>

                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-coins"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">Mínimo tributable</span>
                        <span class="kt-widget__value">{{ $row->min_tax }}</span>
                    </div>
                </div>

                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-users-1"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">Contribuyentes</span>
                        <span class="kt-widget__value">{{ $numTaxpayers }}</span>
                    </div>
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
                    <h3 class="kt-portlet__head-title">
                        Contribuyentes con esta actividad 
                    </h3>
                </div>
               <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        @if (Auth()->user()->can('print.reports'))
                        <a href="{{ Route('print.activity-report', $row->id) }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Imprimir listado">
                            <i class="fas fa-print"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
              
              <table id="tTaxpayersByEconomicActivity" class="table table-bordered table-striped datatables" style="text-align: center">
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
