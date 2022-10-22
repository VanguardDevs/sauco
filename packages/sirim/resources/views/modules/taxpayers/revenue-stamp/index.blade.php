@extends('layouts.template')

@section('title', 'Timbres Fiscales de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div class="col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-cash-register"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Registrar Timbre Fiscal
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['revenue-stamps.store', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Seleccione la licencia<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('license', $existingLicenses, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE'
                            ])
                        !!}

                        @error('license')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Número de Recibo <span class="text-danger">*</span></label>

                        {!! Form::text('payment_num', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                        @error('payment_num')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    

                    <div class="col-lg-12"></div>
                    <br>

                    <div class="col-lg-6">
                        <label >Fecha de registro <span class="text-danger">*</span></label>

                        {!!
                            Form::text("date", '', [
                                'class' => 'form-control',
                                'id' => 'datepicker',
                                'placeholder' => 'Seleccione una fecha',
                                'readonly',
                                'required'
                            ])
                        !!}

                        @error('date')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="col-lg-6">
                        <label class="control-label">Monto<span class="text-danger"> *</span></label>
                        {!!
                            Form::text("amount", null, [
                                "class" => "form-control decimal-input-mask",
                                "placeholder" => "Monto",
                                'required'
                            ])
                        !!}

                        @error('amount')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-12"></div>
                    <br>


                   <div class="col-lg-6">
                       <label>Concepto <span class="text-danger">*</span></label>

                       {!! Form::text('observations', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                       @error('observations')
                           <div class="text text-danger">{{ $message }}</div>
                       @enderror
                   </div>


                    <div class="col-lg-4">
                        <button class="btn btn-success" style="margin-top:2em;"title="Enviar liquidación" type="submit">
                            <i class="fas fa-paper-plane"></i>
                            Enviar
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
                    Timbres Fiscales
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
          <table id="tRevenueStamp" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="20%">Nro.</th>
                <th width="30%">Estado</th>
                <th width="30%">Monto</th>
                <th width="20%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
    </div>
</div>
@endsection
