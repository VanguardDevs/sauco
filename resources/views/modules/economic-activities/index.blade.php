@extends('layouts.template')

@section('title', 'Control de actividades económicas')

@section('breadcrumbs')
    {{ Breadcrumbs::render('economic-activities') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de actividades económicas
               @if (Auth()->user()->hasRole('admin'))
                 <b>(</b> <a href="{{ Route("economic-activities".'.create') }}" title="Registrar comunidad">
                <span>Registrar</span>
              </a><b>)</b>
               @endif
            </h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tEconomicActivities" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">Código</th>
                <th width="50%">Nombre</th>
                <th width="10%">Alícuota</th>
                <th width="15%">Mín. tributable</th>
                <th width="15%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
