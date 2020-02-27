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
        @if ($typeForm == 'edit')
            {!! Form::model($row, ['route' => ["settlements".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
        @endif
        <div class="card-body">

            @foreach($row->economicActivitySettlements as $activitySettlement)
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Código</label>
                        <div class="col-md-12">{{ $activitySettlement->economicActivity->code  }}</div>
                    </div>
                    <div class="col-md-8">
                        <label>Nombre de la actividad</label>
                        <div class="col-md-12"> {{ $activitySettlement->economicActivity->name }}</div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::text("activity_settlements[]", old('activity_settlement', @$row->name), ["Placeholder" => "Monto", "class" => "form-control decimal-input-mask", "required"]) !!}
                    </div>
                </div>
            @endforeach           
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ url('cashbox/settlements') }}" class="btn btn-secondary" id="cancel"><i class="flaticon-cancel"></i>Cancelar</a>

            @if($typeForm == 'update')
                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-rotate-3d"></i>
                    Actualizar
                </button>
            @else
                <button  type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Registrar
                </button>
            @endif
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card -->
@endsection
