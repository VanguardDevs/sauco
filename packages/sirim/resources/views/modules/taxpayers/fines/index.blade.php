@extends('layouts.template')

@section('title', 'Multas y sanciones de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div class="col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-file-medical"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Realizar sanción
                    <small>
                        Seleccione un concepto de recaudación
                    </small>
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['fines.new', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-5">
                        <label class="col-lg-12">Seleccione la ordenanza<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('ordinance', $ordinances, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                                'id' => 'fines',
                                'required'
                            ])
                        !!}

                        @error('ordinance')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-5">
                        <label class="col-lg-12">Seleccione el concepto<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('concept', [], null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                                'id' => 'concepts',
                                'required'
                            ])
                        !!}

                        @error('concept')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-8">
                        <label class="control-label">Monto</label>
                        {!!
                        Form::text("amount", (isset($row->rif) ? $row->getOriginal('amount') : null), [
                            "class" => "form-control decimal-input-mask",
                            "placeholder" => "Monto",
                            "id" => 'rif'
                        ])
                        !!}

                        @error('rif')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-success" style="margin-top:2em;"title="Enviar liquidación" type="submit">
                            <i class="fas fa-paper-plane"></i>
                            Aplicar multa
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif
<div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-folder-open"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Histórico de multas
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table id="tFines" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="10%">Número</th>
                    <th width="10%">Monto</th>
                    <th width="45%">Concepto</th>
                    <th width="15%">Realizada</th>
                    <th width="10%">Estado</th>
                    <th width="10%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
