@extends('layouts.template')

@section('subheader__title', 'Liquidaciones')

@section('title', 'Liquidaciones de '.$row->name)

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
                        Liquidaciones de {{ $row->name }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
              <table id="tLiquidations" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="10%">Número</th>
                        <th width="10%">Monto</th>
                        <th width="60%">Concepto</th>
                        <th width="10%">Estado del pago</th>
                        <th width="10%">Acciones</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/js/liquidations.js') }}"></script>
@endpush
