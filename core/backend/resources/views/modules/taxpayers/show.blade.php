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
                             {{ $row->address }}
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

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Pagos</h3>
            </div>
        </div>
        <div class="kt-portlet__body">
          <table id="tTaxpayerPayments" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="20%">Nro.</th>
                <th width="30%">Estado</th>
                <th width="30%">Monto</th>
                <th width="20%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
</div>

<div id="profile"></div>
@endsection
