@extends('layouts.template')

@section('title', 'Caja')

@section('content')
	<div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <div class="kt-notification">
                    <a class="kt-notification__item" href="{{ url('cashbox/settlements') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-graphic"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Listado de liquidaciones
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ url('cashbox/payments') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-file-1"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Listado de pagos
                            </div>
                        </div>
                    </a>
                    @if(@Auth::user()->can('access.null-settlements'))
                    <a class="kt-notification__item" href="{{ url('cashbox/null-settlements') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon-coins"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Liquidaciones anuladas
                            </div>
                        </div>
                    </a>
                    <a class="kt-notification__item" href="{{ url('cashbox/null-payments') }}">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-protection"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                               Pagos anulados
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
