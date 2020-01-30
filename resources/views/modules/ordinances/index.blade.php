@extends('layouts.template')

@section('title', 'Control de Ordenanzas')

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings/ordinances') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Ordenanzas <b>(</b> <a href="{{ Route("ordinances".'.create') }}" title="Registrar comunidad">
                <span>Registrar</span>
              </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tOrdinances" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="20%">Ley</th>
                <th width="10%">Valor</th>
                <th width="40%">Descripción</th>
                <th width="10%">Publicado</th>
                <th width="10%">Cobro</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
