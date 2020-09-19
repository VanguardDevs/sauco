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
                    @if (Auth::user()->hasRole('admin'))
                    <a class="kt-notification__item" href="{{ route('taxpayers.uptodate') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-graphic"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Contribuyentes al día
                            </div>
                        </div>
                    </a>
                    @endif
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
                    <a class="kt-notification__item" href="{{ route('canceled-liquidations.index') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-graphic"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Liquidaciones anuladas
                            </div>
                        </div>
                    </a>
                    @if (Auth::user()->hasRole('admin'))
                     <a class="kt-notification__item" href="{{ route('null.payments') }}">
                         <div class="kt-notification__item-icon">
                             <i class="flaticon2-protection"></i>
                         </div>
                         <div class="kt-notification__item-details">
                             <div class="kt-notification__item-title">
                                Pagos anulados
                             </div>
                         </div>
                     </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
