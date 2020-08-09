@extends('layouts.template')

@push('js')
<script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush

@section('title', 'Ficha del Contribuyente '.$row->name)

@section('content')

<div class="kt-portlet kt-portlet">
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <a id="taxpayer" class="kt-widget__username" data_id="{{ $row->id }}" href="{{ Route('taxpayers.show', $row->id) }}">
                            {{ $row->name }}   
                            </br>
                            <small> {{ $row->rif }} </small>
                        </a>
                        @if(Auth::user()->can('edit.taxpayers'))
                        <div class="kt-widget__action">
                            <a href="{{ route('taxpayers.edit', $row) }}" class="btn btn-circle btn-icon">
                                <i class="flaticon2-edit kt-font-brand"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="kt-widget__subhead">
                        <a>
                            <i class="fas fa-tag"></i>
                            {{ $row->taxpayerClassification->name }}
                        </a>
                        <a>
                            <i class="flaticon2-maps"></i>
                             {{ $row->fiscal_address }}
                        </a>
                        <a>
                            <i class="flaticon2-new-email"></i>
                            {{ $row->email ?? 'NO REGISTRADO' }}
                        </a>
                        <a>
                            <i class="flaticon2-phone"></i>
                             {{ $row->phone ?? 'NO REGISTRADO' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="taxpayer-payments"></div>

<div id="profile"></div>

<div class="row">
    @if (($row->taxpayerType->description == 'JURÍDICO') || ($row->companies()->first()))
    <div class="col-xl-6 col-sm-6">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Actividades económicas</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @if(@Auth::user()->can('edit.taxpayers'))
                    <a href="{{ route('taxpayer.economic-activities', $row) }}" class="btn btn-circle btn-icon">
                        <i class="flaticon2-edit kt-font-brand"></i>
                    </a>
                    @endif
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget4" id="economic-activities"></div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-xl-6 col-sm-6">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Representante(s)</h3>
                </div>
                @if(Auth()->user()->can('edit.taxpayers'))
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ url("taxpayers/".$row->id."/representation/add") }}" class="btn btn-circle btn-icon">
                        <i class="flaticon2-plus kt-font-brand"></i>
                    </a>
                </div>
                @endif
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget4" id="representations">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
