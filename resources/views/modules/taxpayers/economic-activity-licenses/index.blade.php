@extends('layouts.template')

@section('title', 'Patentes de industria y comercio')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-medical-records"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Listado de patentes de industria y comercio
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
              <table id="tEconomicActivityLicenses" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="5%">Tipo</th>
                        <th width="5%">Número</th>
                        <th width="5%">Año</th>
                        <th width="15%">RIF</th>
                        <th width="50%">Razón social</th>
                        <th width="10%">Emisión</th>
                        <th width="10%">Acciones</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection
