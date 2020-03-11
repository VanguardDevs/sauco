@extends('cruds.form')

@section('title', 'Reporte de facturas procesadas')

@section('form')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header alert alert-danger">
            <h5 class="card-title">Reporte de facturas procesadas</h5>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
       {!! Form::open(['route' => "print.payments.report", 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-12">Seleccione un día</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                {!!   
                    Form::text('date', null, [
                        'class' => 'form-control',
                        'id' => 'kt_datepicker_1',
                        'placeholder' => 'Seleccione una fecha',
                        'readonly' 
                    ]) 
                !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('reports') }}" class="btn btn-danger" id="cancel"><i class="flaticon-cancel"></i>Cancelar</a>
            <button type="submit" class="btn btn-success">
                <i class="flaticon-paper-plane-1"></i>
               Enviar 
            </button>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card -->
@endsection
