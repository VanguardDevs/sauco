@extends('cruds.form')

@section('subheader__title', 'Nueva declaración')

@section('title', 'Nueva declaración')

@section('form')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card card-primary card-outline">
            <div class="card-header alert">
                <div class="row">
                    <h5 class="m-0">
                        Declaración para el período
                        {{ $row->month->name }} - {{ $row->month->year->year }}
                    </h5>
                </div>
            </div>
        </card>

        <!-- form start -->
        <div class="card-body">
            <div class="row">
                <!--<div class="col-md-6">
                    <a href="{{ $row->id }}/group" class="btn btn-secondary btn-lg">
                        <i class="fas fa-layer-group"></i>AGRUPADA                    
                    </a> 
                </div>-->
                <div class="col-md-6">
                    <a href="{{ $row->id }}/normal" class="btn btn-secondary btn-lg">
                        <i class="fas fa-stream"></i>DESGLOSADA
                    </a>
                </div>
            </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ URL::previous() }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i>Regresar</a>
        </div>
    </div>
    <!-- /.card -->
@endsection
