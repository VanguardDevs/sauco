@extends('layouts.template')

@section('title', 'Declaraciones recibidas')

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
                        Declaraciones recibidas
                    </h3>
                </div>
           </div>
           <div class="kt-portlet__body">
              <table id="tAffidavits" class="table table-bordered table-striped datatables" style="text-align: center">
                    <thead>
                        <tr>
                            <th width="45%">Razón Social</th>
                            <th width="10%">Mes</th>
                            <th width="10%">Año</th>
                            <th width="15%">Recibida</th>
                            <th width="15%">Usuario</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
