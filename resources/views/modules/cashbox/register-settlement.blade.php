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
            <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Datos generales del contribuyente
                </div>
            </div>

            <table class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="10%">RIF</th>
                    <th width="45%">Nombre</th>
                    <th width="45%">Dirección</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $row->taxpayer->rif }}</td> 
                        <td>{{ $row->taxpayer->name  }}</td>   
                        <td>{{ $row->taxpayer->fiscal_address }}</td>
                    </tr>
                </tbody>
            </table>

            </br>
            <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Declaraciones por actividad económica
                </div>
            </div>

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
