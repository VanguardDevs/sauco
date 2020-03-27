@extends('layouts.template')

@section('title', 'Liquidaciones anuladas')

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert">
          <div class="row">
            <h5 class="m-0">
                Liquidaciones anuladas
            </h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tNullSettlements" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">N°</th>
                <th width="10%">RIF</th>
                <th width="50%">Concepto</th>
                <th width="15%">Monto</th>
                <th width="15%">Anulada</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
