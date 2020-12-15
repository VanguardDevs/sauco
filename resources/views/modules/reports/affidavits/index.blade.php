@extends('layouts.template')

@section('title', 'Declaraciones recibidas')

@section('content')
    <!-- general form elements -->
    @if(Auth::user()->can('print.reports'))
    <div class="kt-portlet">
        <!-- /.card-header -->
        <!-- form start -->
       {!! Form::open(['route' => "print.affidavits.report", 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label class="col-lg-12">Seleccione un día</label>
                <div class="col-lg-5">
                {!!   
                    Form::text('first_date', null, [
                        'class' => 'form-control',
                        'id' => 'datepicker',
                        'placeholder' => 'Seleccione una fecha',
                        'readonly' 
                    ]) 
                !!}
                </div>
                <div class="col-lg-5">
                {!!   
                    Form::text('last_date', null, [
                        'class' => 'form-control',
                        'id' => 'datepicker',
                        'placeholder' => 'Seleccione una fecha',
                        'readonly' 
                    ]) 
                !!}
                </div>
                <div class="col-lg-2 col-md-9 col-sm-4">
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

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
             <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fas fa-file-medical"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Declaraciones recibidas
                    </h3>
                </div>
           </div>
           <div class="kt-portlet__body">
              <table id="tAffidavits" class="table table-bordered table-striped datatables" style="text-align: center">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Mes</th>
                            <th width="10%">Año</th>
                            <th width="40%">Razón Social</th>
                            <th width="15%">Recibida</th>
                            <th width="15%">Usuario</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
