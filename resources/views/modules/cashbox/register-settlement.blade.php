@extends('cruds.form')

@section('title', 'Liquidación '.$row->id)

@section('form')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header alert alert-danger">
           @if ($typeForm == 'edit')
                <h5 class="card-title">Calcular liquidación</h5>
           @else
                <h5>Liquidación n° {{ $row->id }}</h5>
           @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if (($typeForm == 'edit-normal') || ($typeForm == 'edit-group'))
            {!! Form::model($row, ['route' => ["settlements".'.update', $row->id, $typeForm], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
        @endif
        <div class="card-body">
            @if (($typeForm == 'edit-normal') || ($typeForm == 'show'))            
            @foreach($row->economicActivitySettlements as $activitySettlement)
                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12">Código</label>
                        <div class="col-md-12">{{ $activitySettlement->economicActivity->code  }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-12">Nombre de la actividad</label>
                        <div class="col-md-12"> {{ $activitySettlement->economicActivity->name }}</div>
                    </div>
                    @if($typeForm == 'edit-normal')
                    <div class="col-md-3">
                        <label class="col-md-12">Monto declarado</label>
                        {!! Form::text("activity_settlements[]", old('activity_settlement', @$row->name), ["class" => "form-control decimal-input-mask col-md-12", "required"]) !!}
                    </div>
                    @else
                    <div class="col-md-2">
                        <label class="col-md-12">Monto declarado</label>
                        <div class="col-md-12">{{ $activitySettlement->brute_amount  }}</div>
                    </div>
                    <div class="col-md-2">
                        <label class="col-md-12">Monto total</label>
                        <div class="col-md-12">{{ $activitySettlement->amount  }}</div>
                    </div>
                    @endif
                </div>
            @endforeach           
            @else
            <div class="form-group row">
                    <label class="col-md-12">Monto</label>
                    {!! Form::text("activity_settlements[]", old('activity_settlement', @$row->name), ["class" => "form-control decimal-input-mask col-md-12", "required"]) !!}
            </div>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            @if($typeForm == 'show')
            <a href="{{ url('cashbox/settlements') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i>Regresar</a>
           @else
            <a href="{{ url('cashbox/settlements') }}" class="btn btn-danger" id="cancel"><i class="flaticon-cancel"></i>Cancelar</a>
            <button  type="submit" class="btn btn-primary">
                <i class="fas fa-calculator"></i>
                Calcular y guardar
            </button>
            @endif
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card -->
@endsection
