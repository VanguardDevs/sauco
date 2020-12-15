@extends('layouts.template')

@section('title', 'Reportes')

@section('content')
	<div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-squares-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Reportes    
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ url('reports/payments') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-graphic"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Pagos procesados    
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ route('cancelled-fines.index') }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-stop-circle"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Multas anuladas
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ route('affidavits.index') }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Declaraciones recibidas
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ route('cancelled-payments.index') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-analytics"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Pagos anulados    
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ route('affidavits.index') }}">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Morosidad 
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
