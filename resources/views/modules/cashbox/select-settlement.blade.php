@extends('cruds.form')

@section('subheader__title', 'Liquidación # '.$row->num)

@section('title', 'Liquidación '.$row->num)

@section('form')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card card-primary card-outline">
            <div class="card-header alert">
                <div class="row">
                    <h5 class="m-0">
                        Seleccione el tipo de liquidación
                    </h5>
                </div>
            </div>
        </card>


        <!-- form start -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ $row->id }}/group" class="btn btn-secondary">
                        <i class="fas fa-layer-group"></i>Por actividad económica agrupada 
                    </a> 
                </div>
                <div class="col-md-6">
                    <a href="{{ $row->id }}/normal" class="btn btn-secondary">
                        <i class="fas fa-calculator"></i>Cálculo normal
                    </a>
                </div>
            </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ url('cashbox/settlements') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i>Regresar</a>
        </div>
    </div>
    <!-- /.card -->
@endsection
