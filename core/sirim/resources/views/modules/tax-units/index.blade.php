@extends('layouts.template')

@section('title', 'Control de Unidades Tributarias')

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Unidades Tributarias <b>(</b> <a href="{{ Route("tax-units".'.create') }}" title="Registrar comunidad">
                <span>Registrar</span>
              </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tTaxUnits" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">ID</th>
                <th width="30%">Ley</th>
                <th width="30%">Valor</th>
                <th width="30%">Fecha de publicación</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
