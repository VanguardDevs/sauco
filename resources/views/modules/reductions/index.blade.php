@extends('layouts.template')

@section('title', 'Control de comunidades')

@section('breadcrumbs')
    {{ Breadcrumbs::render('geographic-area/communities') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de comunidades <b>(</b> <a href="{{ Route("communities".'.create') }}" title="Registrar comunidad">
                <span>Registrar</span>
              </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tCommunities" class="table table-bordered table-striped datatables" style="text-align: center">
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
