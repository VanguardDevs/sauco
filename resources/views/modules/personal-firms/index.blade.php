@extends('layouts.template')

@section('title', 'Firmas personales')

@section('breadcrumbs')
    {{ Breadcrumbs::render('properties') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Firmas Personales</h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tPersonalFirms" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="40%">Firma</th>
                <th width="40%">Cargo</th>
                <th width="10%">Fecha de resolución</th>                
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
