@extends('layouts.template')

@section('title', 'Control de sectores económicos')

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings/economic-sectors') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de sectores económicos <b>(</b> <a href="{{ Route("economic-sectors".'.create') }}" title="Registrar comunidad">
                <span>Registrar</span>
              </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tEconomicSectors" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="15%">ID</th>
                <th width="70%">Nombre</th>
                <th width="15%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
