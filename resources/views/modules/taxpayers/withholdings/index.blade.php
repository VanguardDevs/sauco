@extends('layouts.template')

@section('title', 'Solicitudes de '.$taxpayer->rif)

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
                    Realizar retención
                    <small>
                        Ingrese el monto y seleccione el mes de la declaración
                    </small>
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['withholdings.store', $taxpayer], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-5">
                        <label class="col-lg-12">Seleccione el mes<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('month', $months, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                            ])
                        !!}

                        @error('month')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-5">
                        <label class="col-lg-12">Ingrese el monto<span class="text-danger"> *</span></label>

                        {!!
                            Form::text('amount', null, ['class' => 'form-control decimal-input-mask'])
                        !!}

                        @error('amount')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-success" style="margin-top:2em;" title="Guardar retención" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif
@endsection
