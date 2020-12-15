@extends('layouts.template')

@section('title', 'Empresas morosas')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
             <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fas fa-file-medical"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        {{ $totalCompanies }} Empresas morosas
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                @if (Auth()->user()->can('print.reports'))
                    <a href="{{ Route('reports.delinquent-companies', ['pdf' => true]) }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Imprimir listado" target='_blank'>
                        <i class="fas fa-print"></i>
                    </a>
                @endif
                </div>
           </div>
           <div class="kt-portlet__body">
              <table id="tDelinquentCompanies" class="table table-bordered table-striped datatables" style="text-align: center">
                    <thead>
                        <tr>
                            <th width="15%">RIF</th>
                            <th width="40%">Razón Social</th>
                            <th width="30%">Dirección</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/js/delinquent-companies.js') }}"></script>
@endpush