@extends('cruds.form')

@section('title', 'Reporte de facturas procesadas')

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header alert">
            <h5 class="card-title">{{ $row->name }}</h5>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
       {!! Form::open(['route' => "print.payments.report", 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-12">Seleccione un día</label>
                <div class="col-lg-8 col-md-9 col-sm-8">
                {!!   
                    Form::text('date', null, [
                        'class' => 'form-control',
                        'id' => 'kt_datepicker_1',
                        'placeholder' => 'Seleccione una fecha',
                        'readonly' 
                    ]) 
                !!}
                </div>
                <div class="col-lg-4 col-md-9 col-sm-4">
                    <button type="submit" class="btn btn-success">
                        <i class="flaticon-paper-plane-1"></i>
                       Enviar 
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card -->
  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="card card-primary card-outline">
        <div class="card-header alert">
          <div class="row">
            <h5 class="m-0">
                Contribuyentes
            </h5>
          </div>
        </div>

        <div class="card-body">
          <table id="tTaxpayersByEconomicActivity" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">RIF</th>
                <th width="50%">Razón social</th>
                <th width="10%">Comunidad</th>
                <th width="20%">Dirección fiscal</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
