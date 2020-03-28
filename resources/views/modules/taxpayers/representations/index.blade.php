@extends('layouts.template')

@section('title', 'Control de representantes')

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
                        Control de representantes
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
              <table id="tRepresentations" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="10%">Cédula</th>
                        <th width="20%">Nombre</th>
                        <th width="20%">Apellido</th>
                        <th width="30%">Dirección</th>
                        <th width="20%">Teléfono</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection
