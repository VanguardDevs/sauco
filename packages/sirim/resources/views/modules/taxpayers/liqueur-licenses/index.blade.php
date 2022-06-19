@extends('layouts.template')

@section('title', 'Licencias del contribuyente '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('create.licenses'))
<div class="col-md-12">

    @if($requirement)
        <div class="kt-portlet kt-portlet--height-fluid">


            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-paper"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Emitir licencia de expendios
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {!! Form::open(['route' => ['liqueur-license.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                    <div class="form-group row">
                        <div class="col-lg-8">
                            {!!
                                Form::select('correlative', $correlatives, null, [
                                    'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'liqueur-correlative'
                                ])
                            !!}
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-success" type="submit">
                                Enviar
                            </button>
                        </div>
                        <div class="col-lg-12">
                            <br><br>
                        </div>
                        <label class="col-lg-12">Seleccione Horario de Trabajo<span class="text-danger"> *</span></label>

                        <div class="col-lg-5">
                            <label class="col-lg-2">Desde<span class="text-danger"></span></label>
                            {!!
                                Form::select('start-hour', $hours, null, [
                                    'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'start-hour'
                                ])
                            !!}
                            @error('hour')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-5">
                            <label class="col-lg-1">Hasta<span class="text-danger"></span></label>
                            {!!
                                Form::select('finish-hour', $hours, null, [
                                    'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'finish-hour'
                                ])
                            !!}
                            @error('hour')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="col-lg-12"><span class="text-danger"></span></label>
                        <div class="col-lg-5">
                            <label class="col-lg-2">Desde<span class="text-danger"></span></label>
                            {!!
                                Form::select('start-day', $days, null, [
                                    'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'start-day'
                                ])
                            !!}
                            @error('start-day')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-5">
                            <label class="col-lg-2">Hasta<span class="text-danger"></span></label>
                            {!!
                                Form::select('finish-day', $days, null, [
                                    'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'finish-day'
                                ])
                            !!}
                            @error('finish-day')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <label class="col-lg-12"><span class="text-danger"></span></label>

                        <div class="col-lg-5">
                            <label class="col-lg-5">Franquicia Móvil<span class="text-danger"> *</span></label>
                            {!!
                                Form::select('is_mobile', $boolean, null, [
                                    'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'is_mobile'
                                ])
                            !!}
                            @error('boolean')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-5">
                            <label class="col-lg-3">Anexo<span class="text-danger">*</span></label>
                            {!!
                                Form::select('liqueurAnnex', $liqueurAnnexes, null, [
                                    'class' => 'col-md-12 select2',
                                    'placeholder' => 'SELECCIONE',
                                    'id' => 'liqueur_annex',
                                    'required'
                                ])
                            !!}

                            @error('liqueurAnnex')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label class="col-lg-6">Parámetro de Expendio<span class="text-danger">*</span></label>

                            {!!
                                Form::select('liqueurParameter', $liqueurParameters, null, [
                                    'class' => 'col-md-12 select2',
                                    'placeholder' => 'SELECCIONE',
                                    'id' => 'liqueur_parameter',
                                    'required'
                                ])
                            !!}

                            @error('liqueurParameter')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                {!! Form::close() !!}
            </div>
    </div>
    @else
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Debe realizar y pagar la solicitud para poder emitir la licensia</strong> {{ session('error') }}
        </div>

    @endif
</div>
@endif
<div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body">
            <table id="tLiqueurLicensesTaxpayer" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="40%">Número</th>
                    <th width="40%">Fecha de emisión</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection