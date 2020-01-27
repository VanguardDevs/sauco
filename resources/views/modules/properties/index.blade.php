@extends('layouts.template')

@section('title', 'Control de Inmuebles')

@section('breadcrumbs')
    {{ Breadcrumbs::render('properties') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Inmuebles </h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tProperties" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">RIF</th>
                <th width="40%">Razón social</th>
                <th width="15%">Núm. Catastral</th>
                <th width="15%">Calle</th>
                <th width="5%">Local</th>
                <th width="5%">Piso</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
