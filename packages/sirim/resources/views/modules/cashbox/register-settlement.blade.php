@extends('cruds.form')

@section('title', 'Declaración de '.$row->taxpayer->rif)

@section('form')
    <!-- general form elements -->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title" id="affidavit" data_id="{{ $row->id }}">Declaración {{ 'Nro.'.$row->num }} para el período {{ $row->month->name }} -  {{ $row->month->year->year }}</h3>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if (($typeForm == 'edit-normal') || ($typeForm == 'edit-group'))
            {!! Form::open(['route' => ['affidavits.update', $row->id, $typeForm], 'method' => 'put', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
        @endif
        <div class="kt-portlet__body">
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
            @if (($typeForm == 'edit-normal') || ($typeForm == 'show'))
            <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Declaraciones por actividad económica
                </div>
            </div>
            @foreach($row->economicActivityAffidavits as $affidavit)
                <div class="form-group row">
                    <div class="col-md-1">
                        <label class="col-md-12">Código</label>
                        <div class="col-md-12">{{ $affidavit->economicActivity->code  }}</div>
                    </div>
                    <div class="col-md-7">
                        <label class="col-md-12">Nombre de la actividad</label>
                        <div class="col-md-12"> {{ $affidavit->economicActivity->name }}</div>
                    </div>
                    @if($typeForm == 'edit-normal')
                    <div class="col-md-3">
                        <label class="col-md-12">Declarado</label>
                        {!! Form::text("activity_settlements[]", old('activity_settlement', @$row->name), ["class" => "form-control decimal-input-mask col-md-12", "required"]) !!}
                    </div>
                    @else
                    <div class="col-md-2">
                        <label class="col-md-12">Declarado</label>
                        <div class="col-md-12">{{ $affidavit->affidavit_amount  }}</div>
                    </div>
                    <div class="col-md-2">
                        <label class="col-md-12">Calculado</label>
                        <div class="col-md-12">{{ $affidavit->calc  }}</div>
                    </div>
                    @endif
                </div>
            @endforeach
            @if($typeForm == 'show')
           <table class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="50%">Monto total declarado</th>
                        <th width="50%">Monto total calculado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $row->prettyTotalBruteAmount }}
                        <td>{{ $row->prettyTotalCalcAmount }}
                    </tr>
                </tbody>
            </table>
	        </br>
           <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Fecha de ingreso: {{ $row->processed_at }}
                </div>
                <div class="kt-heading kt-heading--md">
                    Usuario: {{ $row->user->full_name }}
                </div>
            </div>
            @endif
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
            <a href="{{ url('taxpayers/'.$row->taxpayer->id.'/affidavits') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i>Ir a declaraciones</a>
                @if(!$row->payment() && auth()->user()->can('process.payments'))
                <a href="{{ route('affidavits.payment', $row) }}" class="btn btn-warning">
                    <i class="fas fa-money-check"></i> Realizar factura
                </a>
                @elseif (count($row->payment()))
                <a href="{{ route('payments.show', $row->payment()->first()) }}" class="btn btn-info">
                    <i class="fas fa-money-check"></i> Ver factura
                </a>
                <a href="{{ route('liquidations.show', $row->liquidation->first()) }}" class="btn btn-success">
                    <i class="fas fa-eye"></i> Ver liquidación
                </a>
                @endif
            @endif
            @if($typeForm == 'edit-group' || $typeForm == 'edit-normal')
            <a href="{{ url('taxpayers/'.$row->taxpayer->id.'/affidavits') }}" class="btn btn-danger" id="cancel"><i class="flaticon-cancel"></i>Cancelar</a>
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
