@extends('layouts.template')

@section('title', 'Control de licencias 2019 - 2020')

@section('breadcrumbs')
    {{ Breadcrumbs::render('old-licenses') }}
@endsection

@section('content')

  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert alert-danger">
          <div class="row">
            <h5 class="m-0">Control de licencias 2019 - 2020</h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tOldLicenses" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="30%">RIF</th>
                <th width="30%">Número</th>
                <th width="30%">Correlativo</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
