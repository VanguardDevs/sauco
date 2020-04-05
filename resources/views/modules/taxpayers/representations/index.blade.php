@extends('layouts.template')

@section('subheader__title', 'Representantes')

@section('title', 'Representantes')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
              <table id="tRepresentations" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="10%">Cédula</th>
                        <th width="40%">Nombre</th>
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
