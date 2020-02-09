@extends('layouts.template')

@section('title', 'Control de Cuentas Bancarias')

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings/bank-accounts') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de Cuentas Bancarias <b>(</b> <a href="{{ Route("bank-accounts".'.create') }}" title="Registrar comunidad">
                <span>Registrar</span>
              </a><b>)</b></h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tBankAccounts" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="15%">Número de cuenta</th>
                <th width="15%">Tipo de cuenta</th>
                <th width="60%">Banco</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
