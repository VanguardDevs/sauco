@extends('layouts.template')

@section('title', 'Patentes')

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
                        Listado de ceses de actividad económica
                    </h3>
                </div>
           </div>
           <div class="kt-portlet__body">
                <table id="tDismissals" class="table table-bordered table-striped datatables" style="text-align: center">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">RIF</th>
                            <th width="50%">Razón social</th>
                            <th width="15%">Fecha de cese</th>
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
<script type="text/javascript" src="{{ URL::asset('assets/js/dismissals.js') }}"></script>
@endpush
