@extends('cruds.form')

@section('subheader__title', 'Facturas procesadas')

@section('title', 'Reporte de facturas procesadas')

@section('content')
    <!-- general form elements -->
    @if(Auth::user()->can('print.reports'))
    <div class="kt-portlet">
        <!-- /.card-header -->
        <!-- form start -->
       {!! Form::open(['route' => "print.payments.report", 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label class="col-lg-12">Seleccione un día</label>
                <div class="col-lg-8 col-md-9 col-sm-8">
                {!!   
                    Form::text('date', null, [
                        'class' => 'form-control',
                        'id' => 'datepicker',
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
    @endif
    <!-- /.card -->
  <div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <div class="kt-portlet">


            <div class="kt-portlet__body">
              <table id="tProcessedPayments" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="10%">N°</th>
                    <th width="10%">RIF</th>
                    <th width="40%">Razón social</th>
                    <th width="10%">Monto</th>
                    <th width="10%">Procesado</th>
                    <th width="10%">Acciones</th>
                  </tr>
                </thead>
              </table>
            </div>

      </div>
    </div>
  </div>

@endsection
